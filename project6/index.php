<!DOCTYPE html>
<html>



  <head>

    <title>LA Crime</title>

  </head>

<?php include_once 'nav.php'; ?>

    <body>

        <script src="test.js"></script>
        <noscript>Your browser does not support Javascript!!!!!</noscript>

        <form name="db_query" id="formSearch" action="test.php" method="post">

            <fieldset>

                <legend>Record Types to Query</legend>

                <input type="checkbox" name="chkCrimeReport" value="CrimeReport" onClick="return KeepCount();">Crime Reports<br>
                <input type="checkbox" name="chkCriminalIncident" value="CriminalIncident" onClick="return KeepCount();">Criminal Incidents<br>
                <input type="checkbox" name="chkDefinedBy" value="DefinedBy" onClick="return KeepCount();">Records Indicating Criminal Incidents Being Defined By Statutes<br>
                <input type="checkbox" name="chkFiledBy" value="FiledBy" onClick="return KeepCount();">Records Indicating Crime Reports Filed By Police Officers<br>
                <input type="checkbox" name="chkMemberOf" value="MemberOf" onClick="return KeepCount();">Records Indicating Police Officers Being Members Of Police Departments<br>
                <input type="checkbox" name="chkPoliceDepartment" value="PoliceDepartment" onClick="return KeepCount();">Police Departments<br>
                <input type="checkbox" name="chkPoliceOfficer" value="PoliceOfficer" onClick="return KeepCount();">Police Officers<br>
                <input type="checkbox" name="chkReportedThrough" value="ReportedThrough" onClick="return KeepCount();">Records Indicating Criminal Incidents Being Reported Through Crime Reports<br>
                <input type="checkbox" name="chkStatusUpdate" value="StatusUpdate" onClick="return KeepCount();">Status Updates<br>
                <input type="checkbox" name="chkStatute" value="Statute" onClick="return KeepCount();">Statutes

            </fieldset>

            <br><br>

            <fieldset>

                <legend>Fields to Extract From Records</legend>

                    <select name="selFields1" id="sf1" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

                    <select name="selFields2" id="sf2" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

                    <select name="selFields3" id="sf3" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

                    <select name="selFields4" id="sf4" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

                    <select name="selFields5" id="sf5" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

                    <select name="selFields6" id="sf6" onClick="UpdateDropdowns();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                    </select>

            </fieldset>

            <br><br>

            <fieldset>

            <legend>Search Criteria</legend>

                <select name="selConstraints1" id="sc1" onClick="UpdateConstraints();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                </select>

                <input type="text" name="txtConstraints1" value="">
                <input type="checkbox" name="chkInt1" ">Integer Value<br>

                <select name="selConstraints2" id="sc2" onClick="UpdateConstraints();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                </select>

                <input type="text" name="txtConstraints2" value="">
                <input type="checkbox" name="chkInt2" ">Integer Value<br>

                <select name="selConstraints3" id="sc3" onClick="UpdateConstraints();">

                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>
                        <option value=" "> </option>

                </select>

                <input type="text" name="txtConstraints3" value="">
                <input type="checkbox" name="chkInt3" ">Integer Value<br>

            </fieldset>

            <br><br><input type="submit" value="Submit">

        </form>

    </body>


</html>
