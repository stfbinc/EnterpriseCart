<%@ Page Language="VB" Debug="True" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<%@ import Namespace="System.Data.SqlClient" %>
<%@ import Namespace="System.Data" %>
<%@ import Namespace="System.Web.UI.WebControls" %>
<%@ import Namespace="System.Web.UI.WebControls.Repeater" %>
<script runat="server">

    Dim CompanyID As String
    Dim DivisionID As String
    Dim DepartmentID As String
    Dim EmployeeID As String
    Dim DLTable As DataTable
    Dim Download As Boolean
    Dim DownloadLocation As String
    Dim CustomerID As String
    
    Sub Page_Load(Sender As Object, e As EventArgs)
        CustomerID = Session("CustomerID")
        If CustomerID Is Nothing Then
            Common.Redirect("loginform.aspx")
        End If
    
        Common.GetCompanyInfo(CompanyID, DivisionID, DepartmentID, EmployeeID)
    
        If IsPostBack Then
            DLTable = ViewState("DLTable")
            Return
        End If
    
        DownloadLocation = Session("DownloadLocation")
        If Not DownloadLocation Is Nothing Then
            Session("DownloadLocation") = Nothing
            DLLiteral.Text = "<" & "script" & ">" & _
            "setTimeout(""document.location.replace('" & DownloadLocation & "')"", 500)" & _
            "<" & "/script" & ">"
        End If
    
        Try
            Dim cmd As New SqlCommand( _
                "SELECT I.ItemName AS ItemName, I.ItemDescription AS ItemDescription, " & _
                "I.DownloadLocation AS DownloadLocation, I.DownloadPassword AS DownloadPassword, " & _
                "D.OrderNumber As OrderNumber, D.OrderLineNumber As OrderLineNumber, " & _
                "D.DownloadCount AS DownloadCount " & _
                "FROM ContractsHeader H, ContractsDetail D, InventoryItems I " & _
                "WHERE H.CompanyID = @CompanyID AND H.DepartmentID = @DepartmentID AND " & _
                "H.DivisionID = @DivisionID AND H.CustomerID = @CustomerID AND " & _
                "D.CompanyID = @CompanyID AND D.DepartmentID = @DepartmentID AND " & _
                "D.DivisionID = @DivisionID AND D.OrderNumber = H.OrderNumber AND " & _
                "I.CompanyID = @CompanyID AND I.DepartmentID = @DepartmentID AND " & _
                "I.DivisionID = @DivisionID AND I.ItemID = D.ItemID AND " & _
                "H.ContractEndDate > GETDATE() " & _
                "ORDER BY D.OrderLineNumber", Common.Connection)
    
            cmd.Parameters.Add("@CompanyID", CompanyID)
            cmd.Parameters.Add("@DepartmentID", DepartmentID)
            cmd.Parameters.Add("@DivisionID", DivisionID)
            cmd.Parameters.Add("@CustomerID", CustomerID)
    
            Dim da As New SqlDataAdapter(cmd)
            DLTable = New DataTable()
            da.Fill(DLTable)
            ViewState("DLTable") = DLTable
            DLRepeater.DataSource = DLTable
            DataBind()
        Catch ex As Exception
            Common.HandleError("Download error", "DatabaseError", ex)
        End Try
    End Sub
    
    Function Downloadable(v As Object) As Boolean
        Dim r As DataRowView = v
        If IsDBNull(r("DownloadCount")) Then
            Return True
        End If
        Dim dcount As Integer = r("DownloadCount")
        Return dcount < 2
    End Function
    
    Sub HandleItemCommand(ByVal sender As Object, ByVal e As RepeaterCommandEventArgs)
        Try
            ' get table row
            If e.Item.ItemIndex >= DLTable.Rows.Count Then
                Return
            End If
            Dim row As DataRow = DLTable.Rows(e.Item.ItemIndex)
            ' get number of download attempts
            Dim cmd As New SqlCommand( _
                "SELECT DownloadCount FROM ContractsDetail " & _
                "WHERE CompanyID = @CompanyID AND DepartmentID = @DepartmentID AND " & _
                "DivisionID = @DivisionID AND OrderNumber = @OrderNumber AND " & _
                "OrderLineNumber = @OrderLineNumber", Common.Connection)
            cmd.Parameters.Add("@CompanyID", CompanyID)
            cmd.Parameters.Add("@DepartmentID", DepartmentID)
            cmd.Parameters.Add("@DivisionID", DivisionID)
            cmd.Parameters.Add("@OrderNumber", row("OrderNumber"))
            cmd.Parameters.Add("@OrderLineNumber", row("OrderLineNumber"))
            Dim cv As Object = Common.ExecuteScalar(cmd)
            Dim count As Integer = 0
            If Not IsDBNull(cv) Then
                count = cv
            End If
            If count >= 2 Then
                Response.Redirect("main.aspx")
            End If
            count += 1
            cmd = New SqlCommand("UPDATE ContractsDetail SET DownloadCount = @DownloadCount " & _
                "WHERE CompanyID = @CompanyID AND DepartmentID = @DepartmentID AND " & _
                "DivisionID = @DivisionID AND OrderNumber = @OrderNumber AND " & _
                "OrderLineNumber = @OrderLineNumber", Common.Connection)
            cmd.Parameters.Add("@DownloadCount", count)
            cmd.Parameters.Add("@CompanyID", CompanyID)
            cmd.Parameters.Add("@DepartmentID", DepartmentID)
            cmd.Parameters.Add("@DivisionID", DivisionID)
            cmd.Parameters.Add("@OrderNumber", row("OrderNumber"))
            cmd.Parameters.Add("@OrderLineNumber", row("OrderLineNumber"))
            cmd.ExecuteNonQuery()
            Session("DownloadLocation") = GetObfuscatedURL(row("DownloadLocation"))
    
            'send email to customer
            cmd = New SqlCommand("SELECT CustomerEmail FROM CustomerInformation " & _
                "WHERE CompanyID = @CompanyID AND DepartmentID = @DepartmentID AND " & _
                "DivisionID = @DivisionID AND CustomerID = @CustomerID", Common.Connection)
            cmd.Parameters.Add("@CompanyID", CompanyID)
            cmd.Parameters.Add("@DepartmentID", DepartmentID)
            cmd.Parameters.Add("@DivisionID", DivisionID)
            cmd.Parameters.Add("@CustomerID", CustomerID)
            cv = Common.ExecuteScalar(cmd)
            If Not IsDBNull(cv) Then
                Dim fileName As String = row("DownloadLocation")
                Dim p As Integer = fileName.LastIndexOf("/")
                Dim q As Integer = fileName.LastIndexOf("\")
                If q > p Then
                    fileName = fileName.Substring(q + 1)
                Else If p >= 0 Then
                    fileName = fileName.Substring(p + 1)
                End If
                Dim CustomerEmail As String = cv
                Dim body As String = String.Format( _
                    "You have downloaded the file {0}." & vbCrLf & _
                    "The password for the archive is '{1}' (without quotes).", _
                    fileName, row("DownloadPassword"))
                Common.SendEmail(Common.SalesEmail, CustomerEmail, "Download", body, False)
            End If
    
            Response.Redirect("main.aspx")
        Catch ex As FormatException
            Common.HandleError("Download error", "DatabaseError", ex)
        End Try
    End Sub
    
    Function GetObfuscatedURL(location As String) As String
        Dim dict As HybridDictionary = Session("DownloadDict")
        If dict Is Nothing Then
            dict = New HybridDictionary()
            Session("DownloadDict") = dict
        End If
        Dim id As String = dict(location)
        If id Is Nothing Then
            id = ""
            Dim I As Integer
            For I = 0 To 5
                id &= Common.Random(1000000, 9999999)
            Next
            dict(location) = id
        End If
        Return Common.ExtendURL("download.aspx?id=" & id)
    End Function

</script>
<html>
<head>
</head>
<body>
    <form runat="server">
        <table style="BORDER-COLLAPSE: collapse" cellpadding="10" border="1" width="100%">
            <tbody>
                <tr>
                    <th colspan="2">
                        Downloads</th>
                </tr>
                <asp:Repeater id="DLRepeater" runat="server" onItemCommand="HandleItemCommand">
                    <ItemTemplate>
                        <tr>
                            <td>
                                <asp:ImageButton id="ImageButton1" runat="server" ImageUrl="images/zip.gif" CommandName="download" Visible='<%# Downloadable(Container.DataItem) %>'></asp:ImageButton>
                                <asp:Label id="NALabel1" runat="server" visible='<%# Not downloadable(Container.DataItem) %>'>Not
                                available</asp:Label>
                            </td>
                            <td>
                                <asp:LinkButton id="LinkButton1" runat="server" CommandName="Download" Visible='<%# Downloadable(Container.DataItem) %>'>
                                    <%# DataBinder.Eval(Container.DataItem, "ItemName") %>
                                </asp:LinkButton>
                                <asp:Label id="NALabel2" runat="server" style="text-decoration: underline" visible='<%# Not Downloadable(Container.DataItem) %>'> <%# DataBinder.Eval(Container.DataItem, "ItemName") %> </asp:Label>
                                <br />
                                <%# DataBinder.Eval(Container.DataItem, "ItemDescription") %> <asp:Label id="NALabel3" runat="server" style="display: block; font-weight: bold" visible='<%# Not Downloadable(Container.DataItem) %>'> You
                                have already downloaded this file two times. Contact STFB Inc. for more attempts </asp:Label>
                            </td>
                        </tr>
                    </ItemTemplate>
                </asp:Repeater>
                <tbody>
                </tbody>
            </tbody>
        </table>
        <p>
        You can download each file no more than 2 times. After that, you'll have to contact
        STFB Inc. for more attempts.<br />
        The password for the zip file will be sent to you by e-mail. </p>
        <asp:Literal id="DLLiteral" runat="server" EnableViewState="False"></asp:Literal>
    </form>
</body>
</html>
