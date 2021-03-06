// generic JS for all tables

$().ready(new function(){

	// function to set listeners in table view
	function setListeners() {
		// select all in table
		$("#selectAllPrograms").click(function () {
			$("#programsTable input:checkbox").prop( "checked", true );
		});
		$("#selectAllUsers").click(function () {
			$("#usersTable input:checkbox").prop( "checked", true );
		});
		$("#selectAllLocations").click(function () {
			$("#locationsTable input:checkbox").prop( "checked", true );
		});
		// select none in table
		$("#selectNonePrograms").click(function () {
			$("#programsTable input:checkbox").prop( "checked", false );
		});
		$("#selectNoneUsers").click(function () {
			$("#usersTable input:checkbox").prop( "checked", false );
		});
		$("#selectNoneLocations").click(function () {
			$("#locationsTable input:checkbox").prop( "checked", false );
		});


		// check if more than one checkbox is checked for editing
		$("#editPrograms").click(function (event) {
			if ($("#programsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a program to edit. Thanks!");
			} else if ($("#programsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only edit one program at a time. Please select only one program to edit. Thanks!");
			} else {
				var siteid = $("#programsTable input:checkbox:checked").val();
				window.location = "/editPrograms?siteid=" + siteid;
			}
		});

		$("#editUsers").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a user to edit. Thanks!");
			} else if ($("#usersTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only edit one user at a time. Please select only one user to edit. Thanks!");
			} else {
				var userid = $("#usersTable input:checkbox:checked").val();
				window.location = "/editUsers?userid=" + userid;				
			}
		});

		$("#editLocations").click(function (event) {
			if ($("#locationsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a location to edit. Thanks!");
			} else if ($("#locationsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only edit one location at a time. Please select only one location to edit. Thanks!");
			} else {
				var locationid = $("#locationsTable input:checkbox:checked").val();
				window.location = "/editLocations?locationid=" + locationid;	
			}
		});

		// check if more than one checkbox is checked for editing
		$("#removePrograms").click(function (event) {
			if ($("#programsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a program to remove. Thanks!");
			} else if ($("#programsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only remove one program at a time. Please select only one program to remove. Thanks!");
			} else {
				var siteid = $("#programsTable input:checkbox:checked").val();
				window.location = "/removePrograms?siteid=" + siteid;
			}
		});

		$("#removeUsers").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a user to remove. Thanks!");
			} else if ($("#usersTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only remove one user at a time. Please select only one user to remove. Thanks!");
			} else {
				var userid = $("#usersTable input:checkbox:checked").val();
				window.location = "/removeUsers?userid=" + userid;				
			}
		});

		$("#removeLocations").click(function (event) {
			if ($("#locationsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("Please select a location to remove. Thanks!");
			} else if ($("#locationsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only remove one location at a time. Please select only one location to remove. Thanks!");
			} else {
				var locationid = $("#locationsTable input:checkbox:checked").val();
				window.location = "/removeLocations?locationid=" + locationid;	
			}
		});

		$("#comparePrograms").click(function (event) {
			if ($("#programsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a few programs to compare. Thanks!");
			} else {
				event.preventDefault();
				var IDs = $("#programsTable input:checkbox:checked").map(function(){
	    			return $(this).val();
	    		}).get();
				var numIDs = [];
	    		$.each(IDs, function(key, value) {
	    			value = parseInt(value);
	    			numIDs.push(value);
	    		});
	    		var json = JSON.stringify(numIDs);
	    		window.location = "/comparePrograms?siteids=" + json;				
			}

		});

		$("#compareUsers").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a few users to compare. Thanks!");
			} else {
				event.preventDefault();
				var IDs = $("#usersTable input:checkbox:checked").map(function(){
	    			return $(this).val();
	    		}).get();
				var numIDs = [];
	    		$.each(IDs, function(key, value) {
	    			value = parseInt(value);
	    			numIDs.push(value);
	    		});
	    		var json = JSON.stringify(numIDs);
	    		window.location = "/compareUsers?userids=" + json;				
			}


		});

		$("#compareLocations").click(function (event) {
			if ($("#locationsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a few locations to compare. Thanks!");
			} else {
				event.preventDefault();
				var IDs = $("#locationsTable input:checkbox:checked").map(function(){
	    			return $(this).val();
	    		}).get();
				var numIDs = [];
	    		$.each(IDs, function(key, value) {
	    			value = parseInt(value);
	    			numIDs.push(value);
	    		});
	    		var json = JSON.stringify(numIDs);
	    		window.location = "/compareLocations?locationids=" + json;
	    	}	

		});


		$("#emailUsers").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a few users to email. Thanks!");
			} else {
				event.preventDefault();
	    		var num = $("#usersTable input:checkbox:checked").length;
	    		if (num == 1) {
	    			var numRec = num + ' Recipient';
	    		} else {
					var numRec = num + ' Recipients';
	    		}
	    		$('#numRecipients').html('<p><strong>To:</strong> ' + numRec + '</p>');
				$('#emailUsersModal').modal('show');
			}
		});

		$("#manageUsersData").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a user to manage their programs. Thanks!");
			} else if ($("#usersTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only manage program data for one user at a time. Please select only one user. Thanks!");
			} else {
				var userid = $("#usersTable input:checkbox:checked").val();
				window.location = "/manageUsersData?userid=" + userid;				
			}
		});

		$("#reassignPrograms").click(function (event) {
			if ($("#programsTable input:checkbox:checked").length == 0) {
				event.preventDefault();
				alert("Please select a few programs to reassign. Thanks!");
			} else {
				event.preventDefault();
				var IDs = $("#programsTable input:checkbox:checked").map(function(){
	    			return $(this).val();
	    		}).get();
				var numIDs = [];
	    		$.each(IDs, function(key, value) {
	    			value = parseInt(value);
	    			numIDs.push(value);
	    		});
	    		var json = JSON.stringify(numIDs);
	    		window.location = "/reassignProgramsList?siteids=" + json;				
			}

		});

	}

	// establish listeners on page load
	setListeners();

	function setupAjaxRun(siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip) {

    	if ($("#tableTabs li").length) {
	    	// update tables in all tabs
	    	var whichTab = '';
	    	$("#tableTabs li").each(function(){
	    		whichTab = $(this).attr('id');
	    		runAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip);
	    	});
    	} else {
    		// on user managment page, just return users table
    		var whichTab = 'filterUsers';
    		var manage = 'True';
	    	runManageAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip, manage);
	    	whichTab = 'filterSites';
	    	runManageAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip, manage); 
    	}

	}


	// generic ajax call
	function runAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip) {
    	// run ajax call
		$.ajax({
	        type: 'GET',
	        url:  '/' + whichTab + '/?siteName=' + siteName + '&siteEmail=' + siteEmail + '&sitePhone=' + sitePhone + '&userName=' + userName + '&userEmail=' + userEmail + '&userOrgName=' + userOrgName + '&locationName=' + locationName + '&locationAddress=' + locationAddress + '&locationCity=' + locationCity + '&locationZip=' + locationZip, 
	        success: function(data){
	        	// reload table
	            $("."+whichTab+"Wrapper").html(data);
	            // update sorting
	           	$.bootstrapSortable(true);
	           	// re-set listeners
	           	setListeners();
	            
	        }
			
	    });

	}

	// manage users ajax call
	function runManageAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip, manage) {
    	// run ajax call
		$.ajax({
	        type: 'GET',
	        url:  '/' + whichTab + '/?siteName=' + siteName + '&siteEmail=' + siteEmail + '&sitePhone=' + sitePhone + '&userName=' + userName + '&userEmail=' + userEmail + '&userOrgName=' + userOrgName + '&locationName=' + locationName + '&locationAddress=' + locationAddress + '&locationCity=' + locationCity + '&locationZip=' + locationZip + '&manage=' + manage, 
	        success: function(data){
	        	// reload table
	            $("."+whichTab+"Wrapper").html(data);
	            // update sorting
	           	$.bootstrapSortable(true);
	           	// re-set listeners
	           	setListeners();
	            
	        }
			
	    });

	}


	$("#sendEmail").click(function (event) {
		// check for a message
		if ($("#userMessage").val().length == 0) {
			event.preventDefault();
			alert("Please enter a message to email. Thanks!");
		} else {
			event.preventDefault();
			var IDs = $("#usersTable input:checkbox:checked").map(function(){
    			return $(this).val();
    		}).get();
			var numIDs = [];
    		$.each(IDs, function(key, value) {
    			value = parseInt(value);
    			numIDs.push(value);
    		});
    		var json = JSON.stringify(numIDs);
    		var subject = $("#userSubject").val();
    		var message = $("#userMessage").val();
    		console.log(message);
    		// send all to Ajax
    		sendEmailToUsers(json, subject, message);
    		//hide modal
			$('#emailUsersModal').modal('hide');					
		}
	});

	// send email to users
	function sendEmailToUsers(json, subject, message) {
		$.ajax({
			type: 'GET',
			url: '/emailUsers?userids=' + json + '&subject=' + subject + '&message=' + encodeURIComponent(message),
			success: function(data){
				alert("Message Sent!");		
			},
			error: function(data){
				alert("There was a problem with your message and it was not sent. Please try again.");		
			}
		});
	}


	// modal button click to run site search ajax 
	$("#submitSearchSites").click(function() {
		// get submitted values
    	var siteName = $("#siteName").val();
    	var siteEmail = $("#siteEmail").val();
    	var sitePhone = $("#sitePhone").val();

    	// get user search terms if those were entered previously
    	var userName = $("#userNameAjax").text();
    	var userEmail = $("#userEmailAjax").text();
    	var userOrgName = $("#userOrgNameAjax").text();

    	// get locations search terms if those were entered previously
    	var locationName = $("#locationNameAjax").text();
    	var locationAddress = $("#locationAddressAjax").text();
    	var locationCity = $("#locationCityAjax").text();
    	var locationZip = $("#locationZipAjax").text();

		// close the modal
    	$('#searchSites').modal('hide');

    	setupAjaxRun(siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip);


	});

	// create listener on enter key to do button click
	$("#searchSites").keydown(function(event){
		if(event.keyCode==13)event.preventDefault();
	    if(event.keyCode == 13){
	        $("#submitSearchSites").click();
	    }
	});


	// modal button click to run user search ajax 
	$("#submitSearchUsers").click(function() {
		// get submitted values
    	var userName = $("#userName").val();
    	var userEmail = $("#userEmail").val();
    	var userOrgName = $("#userOrgName").val();

    	// get user search terms if those were entered previously
    	var siteName = $("#siteNameAjax").text();
    	var siteEmail = $("#siteEmailAjax").text();
    	var sitePhone = $("#sitePhoneAjax").text();

    	// get locations search terms if those were entered previously
    	var locationName = $("#locationNameAjax").text();
    	var locationAddress = $("#locationAddressAjax").text();
    	var locationCity = $("#locationCityAjax").text();
    	var locationZip = $("#locationZipAjax").text();

		// close the modal
    	$('#searchUsers').modal('hide');

    	setupAjaxRun(siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip);


	});

	// create listener on enter key to do button click
	$("#searchUsers").keydown(function(event){
		if(event.keyCode==13)event.preventDefault();
	    if(event.keyCode == 13){
	        $("#submitSearchUsers").click();
	    }
	});


	// modal button click to run user search ajax 
	$("#submitSearchLocations").click(function() {
    	// get locations search terms if those were entered previously
    	var locationName = $("#locationName").val();
    	var locationAddress = $("#locationAddress").val();
    	var locationCity = $("#locationCity").val();
    	var locationZip = $("#locationZip").val();

    	// get user search terms if those were entered previously
    	var siteName = $("#siteNameAjax").text();
    	var siteEmail = $("#siteEmailAjax").text();
    	var sitePhone = $("#sitePhoneAjax").text();

    	// get user search terms if those were entered previously
    	var userName = $("#userNameAjax").text();
    	var userEmail = $("#userEmailAjax").text();
    	var userOrgName = $("#userOrgNameAjax").text();


		// close the modal
    	$('#searchLocations').modal('hide');

    	setupAjaxRun(siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip);

	});

	// create listener on enter key to do button click
	$("#searchLocations").keydown(function(event){
		if(event.keyCode==13)event.preventDefault();
	    if(event.keyCode == 13){
	        $("#submitSearchLocations").click();
	    }
	});


	// clear filters button ajax
	$(".clearFilters").click(function() {

    	if ($("#tableTabs li").length) {
	    	// update tables in all tabs
	    	var whichTab = '';
	    	$("#tableTabs li").each(function(){
	    		whichTab = $(this).attr('id');
	    		runAjax(whichTab, '', '', '', '', '', '', '', '', '', '');
	    	});
    	} else {
    		// on user managment page, just return users table
    		var whichTab = 'filterUsers';
    		var manage = 'True';
    		runManageAjax(whichTab, '', '', '', '', '', '', '', '', '', '', manage);
    		whichTab = 'filterSites';
    		runManageAjax(whichTab, '', '', '', '', '', '', '', '', '', '', manage);
    	}

	});

	// preserves carrige returns from a text area input
	$.valHooks.textarea = {
	    get: function(elem) {
	        return elem.value.replace(/\r?\n/g, "<br>");
	    }
	};

		
});
