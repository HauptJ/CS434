<html>



  <head>

    <title>PHP Test</title>

  </head>



    <body>

        <script src="test.js"></script>

        <form name="db_query">

            <fieldset>

                <legend>Record Types to Query</legend>

                <input type="checkbox" name="chkCrimeReport" value="CrimeReport" onClick="return KeepCount()">Crime Reports<br>
                <input type="checkbox" name="chkCriminalIncident" value="CriminalIncident" onClick="return KeepCount()">Criminal Incidents<br>
                <input type="checkbox" name="chkDefinedBy" value="DefinedBy" onClick="return KeepCount()">Records Indicating Criminal Incidents Being Defined By Statutes<br>
                <input type="checkbox" name="chkFiledBy" value="FiledBy" onClick="return KeepCount()">Records Indicating Crime Reports Filed By Police Officers<br>
                <input type="checkbox" name="chkMemberOf" value="MemberOf" onClick="return KeepCount()">Records Indicating Police Officers Being Members Of Police Departments<br>
                <input type="checkbox" name="chkPoliceDepartment" value="PoliceDepartment" onClick="return KeepCount()">Police Departments<br>
                <input type="checkbox" name="chkPoliceOfficer" value="PoliceOfficer" onClick="return KeepCount()">Police Officers<br>
                <input type="checkbox" name="chkReportedThrough" value="ReportedThrough" onClick="return KeepCount()">Records Indicating Criminal Incidents Being Reported Through Crime Reports<br>
                <input type="checkbox" name="chkStatusUpdate" value="StatusUpdate" onClick="return KeepCount()">Status Updates<br>
                <input type="checkbox" name="chkStatute" value="Statute" onClick="return KeepCount()">Statutes

            </fieldset>

            <br><br>

            <fieldset>

                <legend>Fields to Extract From Records</legend>

                    <select name="selFields1">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

                    <select name="selFields2">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

                    <select name="selFields3">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

                    <select name="selFields4">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

                    <select name="selFields5">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

                    <select name="selFields6">

                        <option value="Field1">Field 1</option>
                        <option value="Field2">Field 2</option>
                        <option value="Field3">Field 3</option>
                        <option value="Field4">Field 4</option>
                        <option value="Field5">Field 5</option>
                        <option value="Field6">Field 6</option>
                        <option value="Field7">Field 7</option>
                        <option value="Field8">Field 8</option>
                        <option value="Field9">Field 9</option>
                        <option value="Field10">Field 10</option>
                        <option value="Field11">Field 11</option>
                        <option value="Field12">Field 12</option>
                        <option value="Field13">Field 13</option>

                    </select>

            </fieldset>

            <br><br>

            <fieldset>

            <legend>Search Criteria</legend>

                <select name="selConstraints1">

                    <option value="Constraint1">Constraint 1</option>
                    <option value="Constraint2">Constraint 2</option>
                    <option value="Constraint3">Constraint 3</option>
                    <option value="Constraint4">Constraint 4</option>
                    <option value="Constraint5">Constraint 5</option>
                    <option value="Constraint6">Constraint 6</option>
                    <option value="Constraint7">Constraint 7</option>
                    <option value="Constraint8">Constraint 8</option>
                    <option value="Constraint9">Constraint 9</option>
                    <option value="Constraint10">Constraint 10</option>
                    <option value="Constraint11">Constraint 11</option>
                    <option value="Constraint12">Constraint 12</option>
                    <option value="Constraint13">Constraint 13</option>

                </select>

                <input type="text" name="txtConstraints1" value=""><br>

                <select name="selConstraints2">

                    <option value="Constraint1">Constraint 1</option>
                    <option value="Constraint2">Constraint 2</option>
                    <option value="Constraint3">Constraint 3</option>
                    <option value="Constraint4">Constraint 4</option>
                    <option value="Constraint5">Constraint 5</option>
                    <option value="Constraint6">Constraint 6</option>
                    <option value="Constraint7">Constraint 7</option>
                    <option value="Constraint8">Constraint 8</option>
                    <option value="Constraint9">Constraint 9</option>
                    <option value="Constraint10">Constraint 10</option>
                    <option value="Constraint11">Constraint 11</option>
                    <option value="Constraint12">Constraint 12</option>
                    <option value="Constraint13">Constraint 13</option>

                </select>

                <input type="text" name="txtConstraints2" value=""><br>

                <select name="selConstraints3">

                    <option value="Constraint1">Constraint 1</option>
                    <option value="Constraint2">Constraint 2</option>
                    <option value="Constraint3">Constraint 3</option>
                    <option value="Constraint4">Constraint 4</option>
                    <option value="Constraint5">Constraint 5</option>
                    <option value="Constraint6">Constraint 6</option>
                    <option value="Constraint7">Constraint 7</option>
                    <option value="Constraint8">Constraint 8</option>
                    <option value="Constraint9">Constraint 9</option>
                    <option value="Constraint10">Constraint 10</option>
                    <option value="Constraint11">Constraint 11</option>
                    <option value="Constraint12">Constraint 12</option>
                    <option value="Constraint13">Constraint 13</option>

                </select>

                <input type="text" name="txtConstraints3" value=""><br>

        </form>

    </body>


</html>