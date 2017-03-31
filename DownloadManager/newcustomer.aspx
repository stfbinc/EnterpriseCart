<%@ Page Language="VB" %>
<%@ Register TagPrefix="stfb" TagName="common" Src="../common.ascx" %>
<%@ import Namespace="System.Data" %>
<%@ import Namespace="System.Data.SqlClient" %>
<script runat="server">

    Dim CompanyID As String = ""
    Dim DivisionID As String = ""
    Dim DepartmentID As String = ""
    Dim EmployeeID As String = ""
    
    Sub Page_Load(ByVal Sender As Object, ByVal E As EventArgs)
        Common.CheckSession()
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
    
        EmployeeID = Session("EmployeeID")
        If Session("EmployeeID") = "" And EmployeeID = "" Then
            EmployeeID = "Website"
            Session("EmployeeID") = EmployeeID
        End If
        If Not IsPostBack Then
            Common.SetCountryList(CBCustomerCountry)
            Common.SetCountryList(CBShippingCountry)
        End If
    
        'It is possible to fill prelimanary Customer info from STFBLead Cookie
        'You should just uncomment the lines below and corresponding part of codes
        'in the OKButtonClick method.
        'The only problem, that we can't remove cookie after its using.
        'Cookies.Remove("STFBLead") method doesn't work by some reason.
    
        '        If Not IsPostBack Then
        '             dim Cookie as HttpCookie  = Request.Cookies("STFBLead")
        '             If Not Cookie is Nothing  Then
        '                TBLogin.Text = Cookie.Values("LeadLogin")
        '                TBPassword.Text = Cookie.Values("LeadPassword")
        '                TBFirstName.Text = Cookie.Values("LeadFirstName")
        '                TBLastName.Text = Cookie.Values("LeadLastName")
        '                TBEmail.Text = Cookie.Values("LeadEmail")
        '                TBCountry.Text = Cookie.Values("LeadCountry")
        '                TBAddress1.Text = Cookie.Values("LeadAddress1")
        '                TBAddress2.Text = Cookie.Values("LeadAddress2")
        '                TBAddress3.Text = Cookie.Values("LeadAddress3")
        '                TBCity.Text = Cookie.Values("LeadCity")
        '                TBState.Text = Cookie.Values("LeadState")
        '                TBZip.Text = Cookie.Values("LeadZip")
        '                TBSalutation.Text = Cookie.Values("LeadSaluation")
        '                TBCountry.Text = Cookie.Values("LeadCountry")
        '             End If
        '        End If
    
    End Sub
    
    Sub OKButtonClick(ByVal sender As Object, ByVal e As EventArgs)
        ' add a new customer
        Try
               If AddLocationButton.Text = "Update New Location Info" Then
                   If AddShippingInfo() = False Then Return
               Else If UpdateShippingInfo() = False Then
                   Return
               End If
               If UpdateCustomerInfo() = False Then Return
               Session("CustomerID") = TBLogin.Text
               If Not Request.QueryString("to_checkout") Is Nothing Then
                   Common.Redirect("checkout.aspx")
               Else
                   Common.Redirect("main.aspx")
               End If
        Catch ex As FormatException
            Common.HandleError("can't post new customer data", "DatabaseError", ex)
        Finally
            Common.Connection.Close()
        End Try
    
    End Sub
    
    Sub CancelButtonClick(ByVal sender As Object, ByVal e As EventArgs)
        Common.Redirect("loginform.aspx")
    End Sub
    
    Sub CBLocation_SelectedIndexChanged(ByVal sender As Object, ByVal e As EventArgs)
        ' load shipping location
        ViewState("CustomerShipToID") = CBLocation.SelectedItem.Value
        LoadShippingInfo()
    End Sub
    
    Sub AddLocationButton_Click(ByVal sender As Object, ByVal e As EventArgs)
        If AddLocationButton.Text = "Add New Location" Then
            AddLocationButton.Text = "Update New Location Info"
            CBLocation.Visible = False
            TBLocation.Visible = True
            ErrorText.Text=""
        Else If AddShippingInfo() = True Then
            AddLocationButton.Text = "Add New Location"
            TBLocation.Visible = False
            CBLocation.Visible = True
            ErrorText.Text=""
       End If
    End Sub
    
       '**********************************************************
       'Methods
       '**********************************************************
    
    Sub LoadShippingList()
        ' load ShipTo locations
        If TBLogin.Text = "" Then Return
        Dim myCommand As New SqlCommand( _
          "SELECT ShipToID FROM CustomerShipToLocations WHERE " & _
          "CompanyID = @CompanyID AND DepartmentID = @DepartmentID AND DivisionID = @DivisionID " & _
          "AND CustomerID = @CustomerID ORDER BY ShipToID", Common.connection())
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        myCommand.Parameters.Add("@CustomerID", TBLogin.Text)
        CBLocation.DataSource = Common.ExecuteReader(myCommand, CommandBehavior.CloseConnection)
        CBLocation.DataTextField="ShipToID"
        CBLocation.DataBind()
    End Sub
    
    Sub LoadShippingInfo()
        If ViewState("CustomerShipToID") = "" Then
            If Not CBLocation.SelectedItem Is Nothing Then
                ViewState("CustomerShipToID") = CBLocation.SelectedItem.Value
            Else
                Return
            End If
        End If
        Dim myCommand As New SqlCommand( _
          "SELECT ShipToName, ShipToAddress1, ShipToAddress2, ShipToAddress3, ShipToState, " & _
          "ShipToCity, ShipToZip, ShipToCountry FROM CustomerShipToLocations " & _
          "WHERE CompanyID = @CompanyID AND DivisionID = @DivisionID " & _
          "AND DepartmentID = @DepartmentID AND CustomerID = @CustomerID " & _
          "AND ShipToID = @ShipToId", Common.connection())
        ' set company info params
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        ' set CustomerID and ShipToID params
        myCommand.Parameters.Add("@CustomerID", TBLogin.Text)
        myCommand.Parameters.Add("@ShipToID", ViewState("CustomerShipToID"))
        ' read data
        Dim reader As SqlDataReader= Common.ExecuteReader(myCommand)
        If Not reader.Read() Then
            reader.Close()
            Common.Redirect("main.aspx")
        End If
        ' Bind Shipping controls
        TBShippingName.Text = Common.getValue(reader, "ShipToName")
        TBShippingAddress1.Text = Common.getValue(reader, "ShipToAddress1")
        TBShippingAddress2.Text = Common.getValue(reader, "ShipToAddress2")
        TBShippingAddress3.Text = Common.getValue(reader, "ShipToAddress3")
        TBShippingState.Text = Common.getValue(reader, "ShipToState")
        TBShippingCity.Text = Common.getValue(reader, "ShipToCity")
        TBShippingZip.Text = Common.getValue(reader, "ShipToZip")
        Common.SetSelectedValue(CBShippingCountry, Common.getValue(reader, "ShipToCountry"))
        Common.SetSelectedValue(CBLocation, ViewState("CustomerShipToID"))
        reader.Close()
    End Sub
    
    Function UserExists(ByVal Login As String) As Boolean
        ' check whether we already have a user with same login name
        Dim myCommand As New SqlCommand( _
          "SELECT CustomerLogin FROM CustomerInformation WHERE CustomerLogin = @CustomerLogin " & _
          "AND CompanyID = @CompanyID AND DivisionID = @DivisionID AND DepartmentID = @DepartmentID", Common.Connection)
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        myCommand.Parameters.Add("@CustomerLogin", Login)
    
        If Not (Common.ExecuteScalar(myCommand) Is Nothing) Then
            ErrorText.Text = "User " & TBLogin.Text & " already exists."
            Return True
        End If
    
        Return False
    End Function
    
    Function UpdateCustomerInfo() As Boolean
    
        Common.Debug("UpdateCustomerInfo()")
    
        ' get login and password
        Dim Login As String = TBLogin.Text
        Dim Password As String = TBPassword.Text
    
        If UserExists(Login) Then
            Common.Debug("user already exists")
            Return False
        End If
        ' check password
        If Password <> TBConfirmPassword.Text Then
            Common.Debug("passwords do not match")
            ErrorText.Text = "Passwords do not match."
            Return False
        End If
    
        Common.Debug("creating a new user")
        ' add customer
         Dim myCommand As New SqlCommand( _
          "INSERT INTO CustomerInformation(ID, CompanyID, DivisionID, DepartmentID, CustomerID, CustomerLogin, " & _
          "CustomerPassword, CustomerName, CustomerEmail, CustomerPhone, CustomerCountry, CustomerAddress1, " & _
          "CustomerAddress2, CustomerAddress3, CustomerCity, CustomerState, CustomerZip, CustomerFirstName, CustomerLastName, " & _
          "CustomerSalutation)" & _
          "VALUES(@ID, @CompanyID, @DivisionID, @DepartmentID, @CustomerID, @CustomerLogin, " & _
          "@CustomerPassword, @CustomerName, @CustomerEmail, @CustomerPhone, @CustomerCountry, @CustomerAddress1, " & _
          "@CustomerAddress2, @CustomerAddress3, @CustomerCity, @CustomerState, @CustomerZip, @CustomerFirstName, @CustomerLastName, " & _
          "@CustomerSalutation)", Common.Connection)
        myCommand.Parameters.Add("@ID", CompanyID & DivisionID & DepartmentID & Login)
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        myCommand.Parameters.Add("@CustomerID", Login)
        myCommand.Parameters.Add("@CustomerLogin", Login)
        myCommand.Parameters.Add("@CustomerPassword", Password)
        myCommand.Parameters.Add("@CustomerName", TBCustomer.Text)
        myCommand.Parameters.Add("@CustomerEmail", TBEmail.Text)
        myCommand.Parameters.Add("@CustomerPhone", TBPhone.Text)
        myCommand.Parameters.Add("@CustomerCountry", CBCustomerCountry.SelectedItem.Value)
        myCommand.Parameters.Add("@CustomerAddress1", TBAddress1.Text)
        myCommand.Parameters.Add("@CustomerAddress2", TBAddress2.Text)
        myCommand.Parameters.Add("@CustomerAddress3", TBAddress3.Text)
        myCommand.Parameters.Add("@CustomerCity", TBCity.Text)
        myCommand.Parameters.Add("@CustomerState", TBState.Text)
        myCommand.Parameters.Add("@CustomerZip", TBZip.Text)
        myCommand.Parameters.Add("@CustomerFirstName", TBFirstName.Text)
        myCommand.Parameters.Add("@CustomerLastName", TBLastName.Text)
        myCommand.Parameters.Add("@CustomerSalutation", TBSalutation.Text)
        If myCommand.ExecuteNonQuery() = 1 Then
        '      dim Cookie as HttpCookie  = Request.Cookies("STFBLead")
        '      If Not Cookie is Nothing Then
        '        myCommand = New SqlCommand( _
        '            "DELETE FROM LeadInformation WHERE CompanyID=@CompanyID And DivisionID=@DivisionID And  DepartmentID=@DepartmentID And LeadID=@LeadID", myConnection)
        '        myCommand.Parameters.Add("@CompanyID", CInfo.CompanyID)
        '        myCommand.Parameters.Add("@DivisionID", CInfo.DivisionID)
        '        myCommand.Parameters.Add("@DepartmentID", CInfo.DepartmentID)
        '        myCommand.Parameters.Add("@LeadID", Cookie.Values("LeadID"))
        '        myCommand.ExecuteNonQuery()
        '        Response.Cookies.Remove("STFBLead")
        '      End If
           Return True
        End If
        Return False
    End Function
    
    Function UpdateShippingInfo() As Boolean
        If ViewState("CustomerShipToID") = "" Then Return True
        Dim myCommand As New SqlCommand( _
         "Update CustomerShipToLocations Set ShipToName=@ShipToName, ShipToAddress1=@ShipToAddress1, ShipToAddress2=@ShipToAddress2, ShipToAddress3=@ShipToAddress3, ShipToState=@ShipToState, " & _
         "ShipToCity=@ShipToCity, ShipToZip=@ShipToZip, ShipToCountry=@ShipToCountry " & _
         "WHERE CompanyID = @CompanyID AND DivisionID = @DivisionID " & _
         "AND DepartmentID = @DepartmentID AND CustomerID = @CustomerID " & _
         "AND ShipToID = @ShipToId", Common.Connection())
    
        ' set company info params
        myCommand.Parameters.Add("@CompanyID", CompanyID)
        myCommand.Parameters.Add("@DivisionID", DivisionID)
        myCommand.Parameters.Add("@DepartmentID", DepartmentID)
        ' set CustomerID and ShipToID params
        myCommand.Parameters.Add("@CustomerID", TBLogin.Text)
        myCommand.Parameters.Add("@ShipToId", ViewState("CustomerShipToID"))
    
        myCommand.Parameters.Add("@ShipToName", TBShippingName.Text)
        myCommand.Parameters.Add("@ShipToAddress1", TBShippingAddress1.Text)
        myCommand.Parameters.Add("@ShipToAddress2", TBShippingAddress2.Text)
        myCommand.Parameters.Add("@ShipToAddress3", TBShippingAddress3.Text)
        myCommand.Parameters.Add("@ShipToState", TBShippingState.Text)
        myCommand.Parameters.Add("@ShipToCity", TBShippingCity.Text)
        myCommand.Parameters.Add("@ShipToZip", TBShippingZip.Text)
        myCommand.Parameters.Add("@ShipToCountry", CBShippingCountry.SelectedItem.Value)
        myCommand.ExecuteNonQuery()
        Return True
    End Function
    
    Function AddShippingInfo() As Boolean
        If UserExists(TBLogin.Text) Then
            Return False
        End If
        Try
            Dim ShipToID As String = TBLocation.Text
            Dim myCommand As New SqlCommand( _
            "INSERT INTO CustomerShipToLocations(ID, CompanyID, DivisionID, DepartmentID, CustomerID, ShipToID, " & _
            "ShipToName,ShipToAddress1,ShipToAddress2, ShipToAddress3,ShipToState,ShipToCity,ShipToZip,ShipToCountry)" & _
            "VALUES(@ID, @CompanyID, @DivisionID, @DepartmentID, @CustomerID, @ShipToID, " & _
            "@ShipToName,@ShipToAddress1,@ShipToAddress2, @ShipToAddress3,@ShipToState,@ShipToCity,@ShipToZip,@ShipToCountry)", Common.Connection)
            ' set company info params
            myCommand.Parameters.Add("@ID", CompanyID & DivisionID & DepartmentID & TBLogin.Text & ShipToID)
            myCommand.Parameters.Add("@CompanyID", CompanyID)
            myCommand.Parameters.Add("@DivisionID", DivisionID)
            myCommand.Parameters.Add("@DepartmentID", DepartmentID)
            ' set CustomerID and ShipToID params
            myCommand.Parameters.Add("@CustomerID", TBLogin.Text)
            myCommand.Parameters.Add("@ShipToId", ShipToID)
    
            myCommand.Parameters.Add("@ShipToName", TBShippingName.Text)
            myCommand.Parameters.Add("@ShipToAddress1", TBShippingAddress1.Text)
            myCommand.Parameters.Add("@ShipToAddress2", TBShippingAddress2.Text)
            myCommand.Parameters.Add("@ShipToAddress3", TBShippingAddress3.Text)
            myCommand.Parameters.Add("@ShipToState", TBShippingState.Text)
            myCommand.Parameters.Add("@ShipToCity", TBShippingCity.Text)
            myCommand.Parameters.Add("@ShipToZip", TBShippingZip.Text)
            myCommand.Parameters.Add("@ShipToCountry", CBShippingCountry.SelectedItem.Value)
            If myCommand.ExecuteNonQuery() = 1 Then
                ViewState("CustomerShipToID") = ShipToID
                LoadShippingList()
                LoadShippingInfo()
                'We posted data related with customer,
                'so should disable CustomerID changing
                TBLogin.Enabled = False
                Return True
            End If
        Catch ex As Exception
            Common.HandleError("Can't add new shipping location", "DatabaseError", ex)
        End Try
        Return False
    End Function

</script>
<html>
<head>
    <title>New Customer</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <script language="javascript">

			function bodyScroll()
			{
				var F=document.forms[0];
				F.htmlScrollTop.value=htmlBody.scrollTop;
			}

			function bodyLoad()
			{
				var F=document.forms[0];
				var err=document.all["ErrorText"]
				if(err!=null && err.innerText!="")
				{
					htmlBody.scrollTop=0;
					F.htmlScrollTop.value=htmlBody.scrollTop;
				}
				if(F.htmlScrollTop.value!="")
					htmlBody.scrollTop=F.htmlScrollTop.value;
			}

		</script>
</head>
<body id="htmlBody" onscroll="bodyScroll()" onload="bodyLoad()">
    <form runat="server">
        <input id="htmlScrollTop" type="hidden" runat="server" />
        <asp:Label id="ErrorText" style="COLOR: red" runat="server"></asp:Label>
        <br />
        <table bordercolor="black" cellspacing="0" rules="none" width="100%" border="1">
            <tbody>
                <tr class="headerrow">
                    <td align="middle" colspan="2">
                        Customer Information</td>
                </tr>
                <tr class="oddrow">
                    <td width="20%">
                        Login:</td>
                    <td width="80%">
                        <asp:TextBox id="TBLogin" runat="server" Width="249px"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator2" runat="server" ErrorMessage="Login is required field " ControlToValidate="TBLogin"></asp:RequiredFieldValidator>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Password:</td>
                    <td>
                        <asp:TextBox id="TBPassword" runat="server" Width="249px" TextMode="Password"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator3" runat="server" ErrorMessage="Password is required field" ControlToValidate="TBPassword"></asp:RequiredFieldValidator>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Confirm password:</td>
                    <td>
                        <asp:TextBox id="TBConfirmPassword" runat="server" Width="249px" TextMode="Password"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator4" runat="server" ErrorMessage="Password is required field" ControlToValidate="TBConfirmPassword"></asp:RequiredFieldValidator>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Company Name:</td>
                    <td>
                        <asp:TextBox id="TBCustomer" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        First name</td>
                    <td>
                        <asp:TextBox id="TBFirstName" runat="server" Width="249px" MaxLength="50"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator1" runat="server" ErrorMessage="First Name is required field" ControlToValidate="TBFirstName"></asp:RequiredFieldValidator>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Last name</td>
                    <td>
                        <asp:TextBox id="TBLastName" runat="server" Width="249px" MaxLength="50"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator6" runat="server" ErrorMessage="Last Name is required field" ControlToValidate="TBLastName"></asp:RequiredFieldValidator>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Salutation</td>
                    <td>
                        <asp:TextBox id="TBSalutation" runat="server" Width="249px" MaxLength="50"></asp:TextBox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Email:</td>
                    <td>
                        <asp:TextBox id="TBEmail" runat="server" Width="249px"></asp:TextBox>
                        * 
                        <asp:RequiredFieldValidator id="RequiredFieldValidator5" runat="server" ErrorMessage="Email is required field" ControlToValidate="TBEmail" Display="Dynamic"></asp:RequiredFieldValidator>
                        <asp:RegularExpressionValidator id="RegularExpressionValidator1" runat="server" ErrorMessage="Incorrect Email" ControlToValidate="TBEmail" Display="Dynamic" ValidationExpression="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"></asp:RegularExpressionValidator>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Address1:</td>
                    <td>
                        <asp:TextBox id="TBAddress1" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Address2:</td>
                    <td>
                        <asp:TextBox id="TBAddress2" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Address3:</td>
                    <td>
                        <asp:TextBox id="TBAddress3" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        City</td>
                    <td>
                        <asp:TextBox id="TBCity" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        State:</td>
                    <td>
                        <asp:TextBox id="TBState" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Zip:</td>
                    <td>
                        <asp:TextBox id="TBZip" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Phone:</td>
                    <td>
                        <asp:TextBox id="TBPhone" runat="server" Width="249px"></asp:TextBox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Country:</td>
                    <td>
                        <asp:DropDownList id="CBCustomerCountry" runat="server" Width="249px" Font-Size="8pt"></asp:DropDownList>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td colspan="2">
                        <strong><em><font face="Arial" size="1">&nbsp;Fields marked with an <font color="red">*</font> are
                        required</font></em></strong> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="FONT-SIZE: 0px; HEIGHT: 8px">
        </div>
        <table bordercolor="black" cellspacing="0" rules="none" width="100%" align="center" border="1">
            <tbody>
                <tr class="headerrow">
                    <td align="middle" colspan="2">
                        <strong><font face="Arial" size="3">Ship To Locations:</font></strong></td>
                </tr>
                <tr class="oddrow">
                    <td width="130">
                        <asp:Label id="LLocation" runat="server">Location</asp:Label></td>
                    <td>
                        <a name="#CBLocation"></a>
                        <asp:dropdownlist id="CBLocation" runat="server" Width="249px" Font-Size="8pt" OnSelectedIndexChanged="CBLocation_SelectedIndexChanged" AutoPostBack="True"></asp:dropdownlist>
                        <asp:textbox id="TBLocation" runat="server" Width="249px" Font-Size="8pt" Visible="False"></asp:textbox>
                        <a name="#AddLocationButton"></a>
                        <asp:button id="AddLocationButton" onclick="AddLocationButton_Click" runat="server" CausesValidation="False" Text="Add New Location"></asp:button>
                        <br />
                        <asp:Label id="Label1" runat="server" cssclass="oddrow" forecolor="DarkBlue">After
                        adding new location you will not be able to change your Login. Check if your Login
                        is valid before updating shipping location </asp:Label></td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Company Name:</td>
                    <td>
                        <asp:textbox id="TBShippingName" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Address1</td>
                    <td>
                        <asp:textbox id="TBShippingAddress1" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Address2:</td>
                    <td>
                        <asp:textbox id="TBShippingAddress2" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Address3:</td>
                    <td>
                        <asp:textbox id="TBShippingAddress3" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        State:</td>
                    <td>
                        <asp:textbox id="TBShippingState" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        City:</td>
                    <td>
                        <asp:textbox id="TBShippingCity" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="evenrow">
                    <td>
                        Zip:</td>
                    <td>
                        <asp:textbox id="TBShippingZip" runat="server" Width="249px" Font-Size="8pt"></asp:textbox>
                    </td>
                </tr>
                <tr class="oddrow">
                    <td>
                        Country:</td>
                    <td>
                        <asp:DropDownList id="CBShippingCountry" runat="server" Width="249px" Font-Size="8pt"></asp:DropDownList>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="FONT-SIZE: 0px; HEIGHT: 4px">
        </div>
        <asp:Button id="Button1" onclick="OKButtonClick" runat="server" Width="75px" Text="OK"></asp:Button>
        <asp:Button id="Button2" onclick="CancelButtonClick" runat="server" Width="85px" CausesValidation="False" Text="Cancel"></asp:Button>
    </form>
</body>
</html>