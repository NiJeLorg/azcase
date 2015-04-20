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
		$("#editPrograms").click(function () {
			if ($("#programsTable input:checkbox:checked").length > 1) {
				alert("You can only edit one program at a time. Please select only one program to edit. Thanks!");
			} else {
				var siteid = $("#programsTable input:checkbox:checked").val();
				window.location = "/editPrograms?siteid=" + siteid;
			}
		});

		$("#editUsers").click(function (event) {
			if ($("#usersTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only edit one user at a time. Please select only one user to edit. Thanks!");
			} else {
				var userid = $("#usersTable input:checkbox:checked").val();
				window.location = "/editUsers?userid=" + userid;				
			}
		});

		$("#editLocations").click(function (event) {
			if ($("#locationsTable input:checkbox:checked").length > 1) {
				event.preventDefault();
				alert("You can only edit one location at a time. Please select only one location to edit. Thanks!");
			} else {
				var locationid = $("#locationsTable input:checkbox:checked").val();
				window.location = "/editLocations?locationid=" + locationid;	
			}
		});
		
	}

	// establish listeners on page load
	setListeners();

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

    	// update tables in all tabs
    	var whichTab = '';
    	$("#tableTabs li").each(function(){
    		whichTab = $(this).attr('id');
    		runAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip)
    	});


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

    	// update tables in all tabs
    	var whichTab = '';
    	$("#tableTabs li").each(function(){
    		whichTab = $(this).attr('id');
    		runAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip)
    	});

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

    	// update tables in all tabs
    	var whichTab = '';
    	$("#tableTabs li").each(function(){
    		whichTab = $(this).attr('id');
    		runAjax(whichTab, siteName, siteEmail, sitePhone, userName, userEmail, userOrgName, locationName, locationAddress, locationCity, locationZip)
    	});

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

    	// update tables in all tabs
    	var whichTab = '';
    	$("#tableTabs li").each(function(){
    		whichTab = $(this).attr('id');
    		runAjax(whichTab, '', '', '', '', '', '', '', '', '', '')
    	});

	});

		
});
