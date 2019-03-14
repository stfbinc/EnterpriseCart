<%@ Page Language="VB" Debug="True" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<%@ import Namespace="System.Data.SqlClient" %>
<%@ import Namespace="System.Data" %>
<%@ import Namespace="System.Drawing" %>
<%@ import Namespace="System.Drawing.Drawing2D" %>
<%@ import Namespace="System.Drawing.Imaging" %>
<script runat="server">

    Dim CompanyID As String = "DEFAULT"
    Dim DivisionID As String = "DEFAULT"
    Dim DepartmentID As String = "DEFAULT"
    Dim ToCheckout As Boolean = False
    Dim ToCheckoutStr As String = ""
    
    Sub Page_Load(Sender As Object, E As EventArgs)
        Common.CheckSession()
        ' Output 'secret word' image, if requested
        If Not Request.QueryString("img") Is Nothing Then
            Dim secretWord As String = Common.Random(10001, 99999).ToString()
            Session("secretWord") = secretWord
            OutputImage(secretWord) ' this will call Response.End()
        End If
        ' Web Matrix Design mode causes problems with everything except <%# ... %> in attributes
        DataBind()
        If Not Request.QueryString("to_checkout") Is Nothing Then
            ToCheckout = True
            NewCustomerLink.NavigateUrl = Common.ExtendURL("newcustomer.aspx?to_checkout=yes")
        End If
    End Sub
    
    Sub OKButton_Click(ByVal sender As Object, ByVal e As EventArgs)
        If Session("secretWord") Is Nothing Then
            ErrorText.Text = "Session expired. Please try again."
            Return
        ElseIf Session("secretWord") <> TBSecretWord.Text Then
            ErrorText.Text = "Invalid confirmation code."
            Return
        End If
        If Login() = True Then
            ' authentication successful
            If ToCheckout Then
                Common.Redirect("checkout.aspx")
            Else
                Common.Redirect("main.aspx")
            End If
        Else
               ' bad login or password
               ErrorText.Text = "Invalid user name or password."
        End If
    End Sub
    
    Sub CancelButton_Click(ByVal sender As Object, ByVal e As EventArgs)
        Common.Redirect("main.aspx")
    End Sub
    
    Sub LogOffButton_Click(ByVal sender As Object, ByVal e As EventArgs)
        Session("CustomerID") = Nothing
        Common.Redirect("main.aspx")
    End Sub
    
    Function Login() As Boolean
        CompanyID = Session("CompanyID")
        If Session("CompanyID") = "" And CompanyID = "" Then
            CompanyID = "DEFAULT"
            Session("CompanyID") = CompanyID
        End If
    
        DivisionID = Session("DivisionID")
        If Session("DivisionID") = "" And DivisionID = "" Then
            DivisionID = "DEFAULT"
            Session("DivisionID") = DivisionID
        End If
    
        DepartmentID = Session("DepartmentID")
        If Session("DepartmentID") = "" And DepartmentID = "" Then
            DepartmentID = "DEFAULT"
            Session("DepartmentID") = DepartmentID
        End If
    
        ' get login and password
        Dim LoginName As String = TBLogin.Text
        Dim Password As String = TBPassword.Text
    
        ' check credentials
        Dim myCommand As New SqlCommand( _
          "SELECT CustomerID FROM CustomerInformation WHERE CustomerLogin = @CustomerLogin " & _
          "AND CompanyID = @CompanyID AND DivisionID = @DivisionID AND DepartmentID = @DepartmentID " & _
          "AND CustomerPassword = @CustomerPassword", Common.connection())
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        myCommand.Parameters.Add("@CustomerLogin", LoginName)
        myCommand.Parameters.Add("@CustomerPassword", Password)
    
        Try
            Dim CustomerID As Object = Common.ExecuteScalar(myCommand)
            If Not CustomerID Is Nothing Then
                Session("CustomerID") = CustomerID
                Return True
            End If
        Finally
            Common.Connection().Close()
        End Try
        Session("CustomerID") = Nothing
        Return False
    End Function
    
    Private Sub OutputImage(ByVal imageText As String)
        Dim bmp As Bitmap = New Bitmap(95, 30)
        Dim g As Graphics = Graphics.FromImage(bmp)
        Dim drawFont As Font = New Font("Arial", 18)
        Dim drawBrush As SolidBrush = New SolidBrush(Color.Black)
        'Create point for upper-left corner of drawing.
        Dim drawPoint As PointF = New PointF(10.0F, 2.0F)
        'Draw string to bitmap
        g.Clear(Color.White)
        DrawGrid(g)
        g.DrawString(imageText, drawFont, drawBrush, drawPoint)
    
        Dim eps As EncoderParameters = New EncoderParameters(1)
        eps.Param(0) = New EncoderParameter(System.Drawing.Imaging.Encoder.Quality, 25L)
        Dim ici As ImageCodecInfo = GetEncoderInfo("image/jpeg")
        Response.Clear()
        Response.Expires = -1
        Response.ContentType = "image/jpeg"
        bmp.Save(Response.OutputStream, ici, eps)
        Response.End()
    End Sub
    
    Private Sub DrawGrid(ByVal g As Graphics)
        Dim b As HatchBrush = New HatchBrush(HatchStyle.DiagonalCross, Color.DarkGray, Color.White)
        g.FillRectangle(b, 0, 0, 95, 30)
    End Sub
    
    Private Shared Function GetEncoderInfo(ByVal mimeType As String) As ImageCodecInfo
        Dim j As Integer = 0
        Dim encoders As ImageCodecInfo()
        encoders = ImageCodecInfo.GetImageEncoders()
        For j = 0 To encoders.Length - 1
            If encoders(j).MimeType = mimeType Then
                Return encoders(j)
            End If
        Next
        Return Nothing
    End Function

</script>
<html>
<head>
    <title>Cart Login</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <form runat="server">
        <asp:Label id="ErrorText" style="DISPLAY: block; COLOR: red" runat="server"></asp:Label>
        <br />
        <table bordercolor="black" height="138" cellspacing="0" rules="none" border="1">
            <tbody>
                <tr class="headerrow">
                    <td colspan="2">
                        <p style="MARGIN-BOTTOM: 0.4em; PADDING-BOTTOM: 0px">
                            Enter you login and password<br />
                            Are you a new user?<br />
                            <asp:hyperlink id="NewCustomerLink" runat="server" NavigateUrl='<%# Common.ExtendURL("newcustomer.aspx") %>'>Click here to create new account!</asp:hyperlink>
                            <br />
                            Forgot your password?<br />
                            <asp:hyperlink id="ForgotPasswordLink" runat="server" NavigateUrl='<%# Common.ExtendURL("forgotpassword.aspx") %>'>Click here to receive your password by email</asp:hyperlink>
                        </p>
                        <p style="MARGIN-TOP: 0px; PADDING-TOP: 0px">
                            <font size="1"><strong>You will also need to enter a confirmation code (displayed
                            in the right</strong>
                            <br />
                            <strong>bottom corner of this window).</strong></font> 
                        </p>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td width="100">
                        Login</td>
                    <td>
                        <asp:textbox id="TBLogin" runat="server" Width="253px"></asp:textbox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Password</td>
                    <td>
                        <asp:textbox id="TBPassword" runat="server" Width="253px" TextMode="Password"></asp:textbox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Confirmation code 
                    </td>
                    <td>
                        <asp:textbox id="TBSecretWord" style="VERTICAL-ALIGN: middle" runat="server" Width="153px" ReadOnly="false"></asp:textbox>
                        <asp:image id="Image1" style="VERTICAL-ALIGN: middle" runat="server" ImageUrl="loginform.aspx?img=1"></asp:image>
                    </td>
                </tr>
            </tbody>
        </table>
        <br />
        <asp:button id="LoginButton" onclick="OKButton_Click" runat="server" Width="90px" Text="Login"></asp:button>
        <asp:button id="LogOffButton" onclick="LogOffButton_Click" runat="server" Width="90px" Text="LogOff"></asp:button>
        <asp:button id="CancelButton" onclick="CancelButton_Click" runat="server" Width="90px" Text="Cancel"></asp:button>
    </form>
</body>
</html>