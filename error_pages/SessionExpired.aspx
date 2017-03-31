<%@ Page Language="VB" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<script runat="server">

    Sub Page_Load(ByVal Sender As Object, ByVal E As EventArgs)
        backlink.NavigateURL = Common.ExtendURL("../main.aspx")
    End Sub

</script>
<html>
<head>
</head>
<body>
    <form runat="server">
        <p>
            <strong><font size="5">Session expired.</font></strong>
        </p>
        <p>
            &nbsp;<asp:HyperLink id="backlink" runat="server">
                <img src="../images/back.gif" border="0" /> 
            </asp:HyperLink>
        </p>
        <p>
            <strong><font size="2"></font></strong>
            <!-- Insert content here -->
        </p>
    </form>
</body>
</html>
