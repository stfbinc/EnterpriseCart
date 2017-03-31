<%@ Page Language="VB" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<script runat="server">

    Sub Page_Load(ByVal Sender As Object, ByVal E As EventArgs)
        If Not Session("LastError") Is Nothing Then
            lblErrorText.Text = Session("LastError")
        End If
        backlink.NavigateUrl = Common.ExtendURL("../default.aspx")
    End Sub

</script>
<html>
<head>
</head>
<body>
    <form runat="server">
        <p>
            <strong><font size="5">Database error.</font></strong> 
         <p>
            <asp:HyperLink id="backlink" runat="server"><img src="../<% =Session("CartTemplate") %>/images/layout/back.gif" border="0" onclick="history.go(-1)"/> 
            </asp:HyperLink>
        </p>
           <hr />
            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:InfoBackground">
            <tr>
            <td>
            <asp:Label ID="lblErrorText" runat="server">
            </asp:Label> 
            </td>
            </tr>
            </table>
        </p>
        <p>
            <strong><font size="2"></font></strong>
            <!-- Insert content here -->
        </p>
    </form>
</body>
</html>
