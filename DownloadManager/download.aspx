<%@ Page Language="VB" Debug="True" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<%@ import Namespace="System.Data.SqlClient" %>
<%@ import Namespace="System.Data" %>
<%@ import Namespace="System.IO" %>
<script runat="server">

    Dim logPath As String = "c:\download.log"
    
    Sub Page_Load(Sender As Object, e As EventArgs)
        If IsPostBack Then
            Return
        End If
    
        Response.Buffer = True
        If Session("CustomerID") Is Nothing Then
            Common.Redirect("loginform.aspx")
        End If
    
        Dim id As String = Request("id")
        If Common.NothingOrEmpty(id) Then
            ErrorLabel.Text = "No item specified"
            Return ' no item specified
        End If
    
        Dim dict As HybridDictionary = Session("DownloadDict")
        If dict Is Nothing Then
            ErrorLabel.Text = "Session expired"
            Return
        End If
    
        Dim location As String
        For Each location In dict.Keys
            If dict(location) = id Then
                ' got it!
                dict.Remove(location)
                SendFile(location)
                Return
            End If
        Next
    
        Common.Redirect("main.aspx")
    End Sub
    
    Sub BackButton_Click(sender As Object, e As ImageClickEventArgs)
        Common.Redirect("main.aspx")
    End Sub
    
    Sub SendFile(location As String)
        'log request
        LogDownload(location)
        'obtain file name
        Dim fileName As String = location
        Dim p As Integer = fileName.LastIndexOf("/")
        Dim q As Integer = fileName.LastIndexOf("\")
        If q > p Then
            fileName = fileName.Substring(q + 1)
        Else If p >= 0 Then
            fileName = fileName.Substring(p + 1)
        End If
        'set file name for 'Download' dialog
        Common.Debug("fileName: {0}", fileName)
        Response.AddHeader("Content-Disposition", String.Format( _
            "inline;filename=""{0}""", fileName.Replace("""", "%22")))
        Try
            Server.Transfer(location)
        Catch ex As Exception
            If TypeOf(ex) Is Threading.ThreadAbortException Then
                Throw ex
            End If
            ErrorLabel.Text = "File not found"
        End Try
    End Sub
    
    Sub LogDownload(location As String)
        Dim fs As FileStream = New FileStream(logPath, FileMode.OpenOrCreate, FileAccess.ReadWrite)
        Dim w As StreamWriter = New StreamWriter(fs)  '  create a Char writer
        w.BaseStream.Seek(0, SeekOrigin.End)          '  set the file pointer to the end
        w.Write(Chr(13) & "Log Entry : ")
        w.Write("{0} {1} " & Chr(13) & Chr(13), DateTime.Now.ToLongTimeString(), _
                DateTime.Now.ToLongDateString())
        w.Write("File: " & location & Chr(13))
        Dim IP As String = Request.UserHostAddress
        If Not Common.NothingOrEmpty(Request.UserHostName) Then
            If Request.UserHostName <> IP Then
                IP &= " (" & Request.UserHostName & ")"
            End If
        End If
        w.Write("IP: " & IP & Chr(13))
        w.Write("------------------------------------" & Chr(13))
        w.Flush()                              '  update underlying file
        w.Close()                              '  close the writer and underlying file
    End Sub

</script>
<html>
<head>
    <title>Error</title>
</head>
<body>
    <form runat="server">
        <p>
            <font size="5"><strong>Error</strong> </font>
        </p>
        <p>
            <asp:Label id="ErrorLabel" runat="server" font-size="Medium">Label</asp:Label>
        </p>
        <p>
            <asp:ImageButton id="BackButton" onclick="BackButton_Click" runat="server" ImageUrl="images/back.gif"></asp:ImageButton>
        </p>
    </form>
</body>
</html>