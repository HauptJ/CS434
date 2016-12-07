function KeepCount() {

    //alert('Entering KeepCount() function!');

    //The counter variable
    var newCount = 0;

    if (document.db_query.chkCrimeReport.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkCriminalIncident.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkDefinedBy.checked){
        newCount = newCount + 1;
    }

    if (document.db_query.chkFiledBy.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkMemberOf.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkPoliceDepartment.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkPoliceOfficer.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkReportedThrough.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkStatusUpdate.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkStatute.checked) {
        newCount = newCount + 1;
    }

    if (newCount > 3) {
        alert('Please pick only three options.');
        document.db_query;
        return false;
    }
}



function AlterCstOptions(pValue, pText, pIndex) {

    //alert('Entering the AlterOptions() function!');
    //Set a currentOpt value equal to the pIndex option of each selFields and update with pValue and pText
    var currentConst = document.getElementById("sc1").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;

    currentConst = document.getElementById("sc2").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;

    currentConst = document.getElementById("sc3").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;
}



function UpdateConstraints() {

    //alert('Entering the UpdateDropdowns() function now.');

    var optionIndex = 0;
    var strIndex = String(optionIndex);
    //alert('index');
    var optionText = "None";
    //alert('text');
    var optionValue = "None";
    //alert('value');
    var content = 'The index, text, and value are: ';
    //alert('content');
    content = content + " " + strIndex + " " + optionText + " " + optionValue;
    //alert(content);

    //Get each selFields <select> control and set the text and values for its 0th-index option to 'None'
    AlterCstOptions(optionValue, optionText, optionIndex);

    //After we've done all that, update the optionIndex value
    optionIndex = optionIndex + 1;

    //Now, we look at EACH checkbox and alter the options depending on the record type!

    //If chkCrimeReport has been checked
    if (document.db_query.chkCrimeReport.checked) {

        //alert('chkCrimeReport has been checked! Prepping for AlterOptions()...');
        //Set the next set of option values for all selField <select>s to ReportNumber
        optionValue = "ReportNumber";
        optionText = "Report Number";

        //Call the AlterOptions() function
        AlterCstOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;


        //Set the next set of option values for all selField <select>s to DateFiled
        optionValue = "DateFiled";
        optionText = "Date Filed";

        //Call the AlterOptions() function
        AlterCstOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;


        //Set the next set of option values for all selField <select>s to Description
        optionValue = "Description";
        optionText = "Description";

        //Call the AlterOptions() function
        AlterCstOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;
    }

    //Repeat the process with all of the others
    if (document.db_query.chkCriminalIncident.checked) {

        //IncidentNumber
        optionValue = "IncidentNumber";
        optionText = "Incident Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //TimeOccurred
        optionValue = "TimeOccurred";
        optionText = "Time Occurred";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //DateOccurred
        optionValue = "DateOccurred";
        optionText = "Date Occurred";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Address
        optionValue = "Address";
        optionText = "Address";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkDefinedBy.checked){

        //Def_IncidentNumber
        optionValue = "Def_IncidentNumber";
        optionText = "(Def) Incident Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Def_CodeDesignation
        optionValue = "Def_CodeDesignation";
        optionText = "(Def) Code Designation";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkFiledBy.checked) {

        //File_DateGraduated
        optionValue = "File_DateGraduated";
        optionText = "(File) Date Graduated)";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //File_BadgeNumber
        optionValue = "File_BadgeNumber";
        optionText = "(File) Badge Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //File_ReportNumber
        optionValue = "File_ReportNumber";
        optionText = "(File) Report Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkMemberOf.checked) {

        //Mem_DateGraduated
        optionValue = "Mem_DateGraduated";
        optionText = "(Mem) Date Graduated";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Mem_BadgeNumber
        optionValue = "Mem_BadgeNumber";
        optionText = "(Mem) Badge Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Mem_PrecinctNumber
        optionValue = "Mem_PrecinctNumber";
        optionText = "(Mem) Precinct Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkPoliceDepartment.checked) {

        //PrecinctNumber
        optionValue = "PrecinctNumber";
        optionText = "Precinct Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Jurisdiction
        optionValue = "Jurisdiction";
        optionText = "Jurisdiction";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkPoliceOfficer.checked) {

        //DateGraduated
        optionValue = "DateGraduated";
        optionText = "Date Graduated";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //BadgeNumber
        optionValue = "BadgeNumber";
        optionText = "Badge Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //LastName
        optionValue = "LastName";
        optionText = "Last Name";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //FirstName
        optionValue = "FirstName";
        optionText = "First Name";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkReportedThrough.checked) {

        //Rep_ReportNumber
        optionValue = "Rep_ReportNumber";
        optionText = "(Rep) Report Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Rep_IncidentNumber
        optionValue = "Rep_IncidentNumber";
        optionText = "(Rep) Incident Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkStatusUpdate.checked) {

        //Stat_ReportNumber
        optionValue = "Stat_ReportNumber";
        optionText = "(Stat) Report Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //RevisionNumber
        optionValue = "RevisionNumber";
        optionText = "Revision Number";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //DateRevised
        optionValue = "DateRevised";
        optionText = "Date Revised";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Status
        optionValue = "Status";
        optionText = "Status";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkStatute.checked) {

        //CodeDesignation
        optionValue = "CodeDesignation";
        optionText = "Code Designation";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //ElementsOfCrime
        optionValue = "ElementsOfCrime";
        optionText = "Elements Of Crime";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    //Finally, if optionIndex < 13
    while (optionIndex < 13) {

        optionValue = "None";
        optionText = " ";
        AlterCstOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

}



function AlterOptions(pValue, pText, pIndex) {

    //alert('Entering the AlterOptions() function!');
    //Set a currentOpt value equal to the pIndex option of each selFields and update with pValue and pText
    var currentOpt = document.getElementById("sf1").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    currentOpt = document.getElementById("sf2").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    currentOpt = document.getElementById("sf3").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    currentOpt = document.getElementById("sf4").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    currentOpt = document.getElementById("sf5").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    currentOpt = document.getElementById("sf6").options[pIndex];
    currentOpt.value = pValue;
    currentOpt.innerHTML = pText;

    var currentConst = document.getElementById("sc1").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;

    currentConst = document.getElementById("sc2").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;

    currentConst = document.getElementById("sc3").options[pIndex];
    currentConst.value = pValue;
    currentConst.innerHTML = pText;
}



function UpdateDropdowns() {

    //alert('Entering the UpdateDropdowns() function now.');

    var optionIndex = 0;
    var strIndex = String(optionIndex);
    //alert('index');
    var optionText = "None";
    //alert('text');
    var optionValue = "None";
    //alert('value');
    var content = 'The index, text, and value are: ';
    //alert('content');
    content = content + " " + strIndex + " " + optionText + " " + optionValue;
    //alert(content);

    //Get each selFields <select> control and set the text and values for its 0th-index option to 'None'
    AlterOptions(optionValue, optionText, optionIndex);

    //After we've done all that, update the optionIndex value
    optionIndex = optionIndex + 1;

    //Now, we look at EACH checkbox and alter the options depending on the record type!

    //If chkCrimeReport has been checked
    if (document.db_query.chkCrimeReport.checked) {

        //alert('chkCrimeReport has been checked! Prepping for AlterOptions()...');
        //Set the next set of option values for all selField <select>s to ReportNumber
        optionValue = "ReportNumber";
        optionText = "Report Number";

        //Call the AlterOptions() function
        AlterOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;


        //Set the next set of option values for all selField <select>s to DateFiled
        optionValue = "DateFiled";
        optionText = "Date Filed";

        //Call the AlterOptions() function
        AlterOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;


        //Set the next set of option values for all selField <select>s to Description
        optionValue = "Description";
        optionText = "Description";

        //Call the AlterOptions() function
        AlterOptions(optionValue, optionText, optionIndex);

        //Update the index number
        optionIndex = optionIndex + 1;
    }

    //Repeat the process with all of the others
    if (document.db_query.chkCriminalIncident.checked) {

        //IncidentNumber
        optionValue = "IncidentNumber";
        optionText = "Incident Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //TimeOccurred
        optionValue = "TimeOccurred";
        optionText = "Time Occurred";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //DateOccurred
        optionValue = "DateOccurred";
        optionText = "Date Occurred";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Address
        optionValue = "Address";
        optionText = "Address";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkDefinedBy.checked){

        //Def_IncidentNumber
        optionValue = "Def_IncidentNumber";
        optionText = "(Def) Incident Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Def_CodeDesignation
        optionValue = "Def_CodeDesignation";
        optionText = "(Def) Code Designation";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkFiledBy.checked) {

        //File_DateGraduated
        optionValue = "File_DateGraduated";
        optionText = "(File) Date Graduated)";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //File_BadgeNumber
        optionValue = "File_BadgeNumber";
        optionText = "(File) Badge Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //File_ReportNumber
        optionValue = "File_ReportNumber";
        optionText = "(File) Report Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkMemberOf.checked) {

        //Mem_DateGraduated
        optionValue = "Mem_DateGraduated";
        optionText = "(Mem) Date Graduated";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Mem_BadgeNumber
        optionValue = "Mem_BadgeNumber";
        optionText = "(Mem) Badge Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Mem_PrecinctNumber
        optionValue = "Mem_PrecinctNumber";
        optionText = "(Mem) Precinct Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkPoliceDepartment.checked) {

        //PrecinctNumber
        optionValue = "PrecinctNumber";
        optionText = "Precinct Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Jurisdiction
        optionValue = "Jurisdiction";
        optionText = "Jurisdiction";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkPoliceOfficer.checked) {

        //DateGraduated
        optionValue = "DateGraduated";
        optionText = "Date Graduated";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //BadgeNumber
        optionValue = "BadgeNumber";
        optionText = "Badge Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //LastName
        optionValue = "LastName";
        optionText = "Last Name";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //FirstName
        optionValue = "FirstName";
        optionText = "First Name";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkReportedThrough.checked) {

        //Rep_ReportNumber
        optionValue = "Rep_ReportNumber";
        optionText = "(Rep) Report Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Rep_IncidentNumber
        optionValue = "Rep_IncidentNumber";
        optionText = "(Rep) Incident Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkStatusUpdate.checked) {

        //Stat_ReportNumber
        optionValue = "Stat_ReportNumber";
        optionText = "(Stat) Report Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //RevisionNumber
        optionValue = "RevisionNumber";
        optionText = "Revision Number";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //DateRevised
        optionValue = "DateRevised";
        optionText = "Date Revised";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //Status
        optionValue = "Status";
        optionText = "Status";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    if (document.db_query.chkStatute.checked) {

        //CodeDesignation
        optionValue = "CodeDesignation";
        optionText = "Code Designation";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;

        //ElementsOfCrime
        optionValue = "ElementsOfCrime";
        optionText = "Elements Of Crime";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

    //Finally, if optionIndex < 13
    while (optionIndex < 13) {

        optionValue = "None";
        optionText = " ";
        AlterOptions(optionValue, optionText, optionIndex);
        optionIndex = optionIndex + 1;
    }

}



function CheckboxChange() {

    alert('Entering CheckboxChange() function!');
    if (KeepCount()) {
        alert('We are updating the dropdowns now');
        UpdateDropdowns();
        return true;
    }
    else {
        return false;
    }
    
}