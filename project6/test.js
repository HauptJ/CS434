function KeepCount() {

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
        NnewCount = newCount + 1;
    }

    if (document.db_query.chkPoliceOfficer.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkReportedThrough.checked) {
        newCount = newCount + 1;
    }

    if (document.db_query.chkStatusUpdate.checked) {
        newCount = newCount + 1
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



function AlterOptions(pValue, pText, pIndex) {

    //Set a currentOpt value equal to the pIndex option of each selFields and update with pValue and pText
    var currentOpt = document.db_query.getElementById("selFields1").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

    currentOpt = document.db_query.getElementsById("selFields2").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

    currentOpt = document.db_query.getElementsById("selFields3").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

    currentOpt = document.db_query.getElementsById("selFields4").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

    currentOpt = document.db_query.getElementsById("selFields5").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

    currentOpt = document.db_query.getElementsById("selFields6").options[optionIndex];
    currentOpt.value = pValue;
    currentOpt.text = pText;

}



function UpdateDropdowns() {

    var optionIndex = 0;
    var optionText = "None";
    var optionValue = "None";

    //Get each selFields <select> control and set the text and values for its 0th-index option to 'None'
    AlterOptions(optionValue, optionText, optionIndex);

    //After we've done all that, update the optionIndex value
    optionIndex = optionIndex + 1;

    //Now, we look at EACH checkbox and alter the options depending on the record type!

    //If chkCrimeReport has been checked
    if (document.db_query.chkCrimeReport.checked) {

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

    if (KeepCount()) {
        UpdateDropdowns();
    }
    else {
        return false;
    }
    
}