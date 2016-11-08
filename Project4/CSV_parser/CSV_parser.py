"""
    This is a sample .CSV (Comma-Separated-Value) File parser.  It contains
    information about all the types of entries that my .CSV file contains, as
    well as the mechanisms to sort entries of one time into their own separate
    INSERT MariaDB statement files.

    First, it creates a .INSERT file for each type of entry in the .CSV file.
    Second, it initializes each .INSERT file according to the attributes of the table.
    Third, it opens a .CSV File.
    Fourth, for each entry in that .CSV File, it:

        Reads in a line of data from the .CSV file.
        Decides which data goes where.
        Formats the data from that line appropriate for the .INSERT files it will be appended to.
        Appends the formatted data to the end of the appropriate .INSERT file.

    Fifth, after it has reached the end of the .CSV file, it makes the final appropriate appends to each .INSERT file and saves + closes them.
"""



# ----------INCLUDED MODULES AND GLOBAL VARIABLES----------



import re

    #data = """part 1;"this is ; part 2;";'this is ; part 3';part 4;this "is ; part" 5"""
    #PATTERN = re.compile(r'''((?:[^;"']|"[^"]*"|'[^']*')+)''')
    #print PATTERN.split(data)[1::2]
    #['part 1', '"this is ; part 2;"', "'this is ; part 3'", 'part 4', 'this "is ; part" 5']
    #replace ; with ,



#Pool of graduation date combinations
GRAD_YEAR = ["1989", "1990", "1991", "1992", "1993", "1994", "1995", "1996", "1997", "1998",
             "1999", "2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008",
             "2009", "2010", "2011", "2012"]

GRAD_MONTH = ["-01-", "-02-", "-03-", "-04-", "-05-", "-06-", "-07-", "-08-", "-09-", "-10-"]

GRAD_DAY = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10"]



#The pattern we're looking for in parsing our CSV file
PATTERN = re.compile(r'''((?:[^,"']|"[^"]*"|'[^']*')+)''')



#Pool of names to choose from 
NAMES_FIRST = ["Aaron", "Alice", "Alex", "Ariel", "Bryan", "Brienne", "Carl", "Caitlyn", "Dennis", "Deidre",
               "Earl", "Elaine", "Francis", "Fawn", "Gary", "Genevieve", "Horus", "Holly", "Ian", "Isabelle",
               "Jack", "Jennifer", "Kingston", "Kelly", "Lucas", "Lily", "Mark", "Marsella", "Nick", "Nadine",
               "Oren", "Olivia", "Patrick", "Priscilla", "Randy", "Rachel", "Ronald", "Rochelle", "Stanley", "Sarah",
               "Timothy", "Tania", "Ulrich", "Ulsana", "Victor", "Valerie", "Winston", "Whitney", "Zachary", "Zariah"]

NAMES_LAST = ["Zimmerman", "Zane", "Yates", "Walton", "Williams", "Xavier", "Valadine", "Ursa", "Tyrannis", "Tory",
              "Smith", "Sortie", "Randall", "Remington", "Rockswell", "Quentin", "Perry", "Pearson", "Overton", "Oscar",
              "Nicholson", "Nedry", "Martin", "Moore", "Lichtinstein", "Laurel", "Krieger", "Kingsworth", "Ivanovich", "Irving",
              "Harolds", "Horton", "Gregoro", "Gray", "Farmsworth", "Earnest", "Dale\'", "Carringson", "Cray", "Connolly\'",
              "Buchner", "Brays", "Allison", "Al-Adin"]


#Pool of .INSERT file format text
TXT_TABLE_NAMES = ["CrimeReport ", "CriminalIncident ", "DefinedBy ", "FiledBy ", "MemberOf ",
                   "PoliceDepartment ", "PoliceOfficer ", "ReportedThrough ", "Statute ", "StatusUpdate "]

TXT_TABLE_ATTRIBUTES = ["(ReportNumber, DateFiled, Description)", "(IncidentNumber, TimeOccurred, DateOccured, Address)",
                        "(Def_IncidentNumber, Def_CodeDesignation)", "(File_DateGraduated, File_BadgeNumber, File_ReportNumber)",
                        "(Mem_DateGraduated, Mem_BadgeNumber, Mem_PrecinctNumber)", "(PrecinctNumber, Jurisdiction)",
                        "(DateGraduated, BadgeNumber, LastName, FirstName)", "(Rep_ReportNumber, Rep_IncidentNumber)",
                        "(CodeDesignation, ElementsOfCrime)", "(Stat_ReportNumber, RevisionNumber, DateRevised, Status)"]


#Twin list of Officer Badge Numbers and Names
LST_OFFICER_NAMES_FIRST = []
LST_OFFICER_NAMES_LAST = []
LST_OFFICER_BADGE = []
LST_OFFICER_GRAD = []


#Pool of Table Lengths


DATA_TABLE_LENGTHS = [3, 4, 2, 3, 3, 2, 4, 2, 2, 4]
DATA_TABLE_CSV_SLOTS = [[1, 0, 8], [1, 3, 2, 11], [1, 7], [17, 6, 1], [17, 6, 4], [4, 5], [17, 6, 15, 16],
                        [1, 1], [7, 7], [1, 18, 0, 19]]


#Maximum index limits for global variables
MAX_INDEX_GRAD_YEAR = 21
MAX_INDEX_GRAD_MONTH = 9
MAX_INDEX_GRAD_DAY = 9

MAX_INDEX_NAME_FIRST = 49
MAX_INDEX_NAME_LAST = 43

MAX_INDEX_TXT = 9


#Current index values for global variables
CUR_INDEX_YEAR = 0
CUR_INDEX_MONTH = 0
CUR_INDEX_DAY = 0

CUR_INDEX_FIRST = 0
CUR_INDEX_LAST = 0

# NOTE: The order of data in the CSV file is: [0]DateReported, [1]ReportNumber, [2]DateOccurred, [3]TimeOccurred,
#       [4]PrecinctNumber, [5]PrecinctName, [6]BadgeNumber, [7]CrimeNumber, [8]CrimeName, [9]StatusUpdate,
#       [10]StatusDescription, [11]Address, [12]CrossStreet, [13]GPS, *[14]Description, *[15]FirstName, *[16]LastName,
#       *[17]DateGraduated, *[18]RevisionNumber, *[19]Status
#
#       All values marked with * are generated by this script



# ----------SECONDARY FUNCTION DECLARATIONS----------


# This is the function that serves as a customizable Readline() alternative
# Credit goes to Stack Overflow's abarnert for this code
def delimited(file, delimiter='"', bufsize=4096):
    buf = ''
    while True:
        newbuf = file.read(bufsize)
        if not newbuf:
            yield buf
            return
        buf += newbuf
        lines = buf.split(delimiter)
        for line in lines[:-1]:
            yield line
        buf = lines[-1]

    """sample use of this function:

    inCSV = open("inCSV.txt","r")
    lines = delimited(inCSV, '"')
    for line in lines:
        print(line)
    inCSV.close()

    """    


# This is the function that writes our extracted data to the .INSERT files in the appropriate format
def write_output(pOrganizedData, pOutputFiles):

    #First, define a Table Counter and an Attribute Counter
    countTable = 0
    countAttribute = 0
    maxAttributes = 0

    #For each table entry that we have data for
    for tableEntry in pOrganizedData:

        #Reset tempData by making it contain ONLY the parenthese that we need to contain it
        pOutputFiles[countTable].write("(")

        #Get a count of how many attributes are in this entry
        maxAttributes = len(tableEntry)

        #Then, for each attribute value in that entry
        for value in tableEntry:

            #Increment the countAttribute counter
            countAttribute += 1

            #Write value to the end of the appropriate output file
            pOutputFiles[countTable].write(str(value))

            #If we aren't at the last item
            if (countAttribute < maxAttributes):

                #Put in the comma and space
                pOutputFiles[countTable].write(", ")

        #Then append it to the end of the appropriate output file
        pOutputFiles[countTable].write("), ")

        #Advance the table counter and reset the attribute counter
        countTable += 1
        countAttribute = 0


# This is the function that generates data and appends it to our pre-existing data
def generate_data(pData):

    #First, get the easy Description variable out of the way
    pData.append("A crime was committed.")

    #Next, we must generate an officer, replete with name and graduation date!
    firstName = ""
    lastName = ""
    gradDate = ""
    badgeNum = pData[6]

    #Establish that these variables are global, because Python is dumb like that
    global CUR_INDEX_DAY
    global CUR_INDEX_MONTH
    global CUR_INDEX_YEAR

    global CUR_INDEX_FIRST
    global CUR_INDEX_LAST
    
    #First, check to see if the badge number is in our directory
    if (badgeNum in LST_OFFICER_BADGE):
        
        #If so, retrieve its index value and populate our data with the appropriate values
        tempIndex = LST_OFFICER_BADGE.index(badgeNum)
        gradDate = LST_OFFICER_GRAD[tempIndex]
        firstName = LST_OFFICER_NAMES_FIRST[tempIndex]
        lastName = LST_OFFICER_NAMES_LAST[tempIndex]

    else:

        #Otherwise, use the existing indices to generate a brand new officer
        firstName = NAMES_FIRST[CUR_INDEX_FIRST]
        lastName = NAMES_LAST[CUR_INDEX_LAST]
        gradDate = GRAD_YEAR[CUR_INDEX_YEAR] + GRAD_MONTH[CUR_INDEX_MONTH] + GRAD_DAY[CUR_INDEX_DAY]

        #Add the officer to the internal directory
        LST_OFFICER_BADGE.append(badgeNum)
        LST_OFFICER_NAMES_FIRST.append(firstName)
        LST_OFFICER_NAMES_LAST.append(lastName)
        LST_OFFICER_GRAD.append(gradDate)

        #Finally, advance the proper indices so that we get new values for everything
        CUR_INDEX_DAY += 1
        CUR_INDEX_FIRST += 1

        #If any of the indices exceed the bounds, reset them to 0 and advance the appropriate index
        if (CUR_INDEX_DAY > MAX_INDEX_GRAD_DAY):
            CUR_INDEX_DAY = 0
            CUR_INDEX_MONTH += 1

        if (CUR_INDEX_MONTH > MAX_INDEX_GRAD_MONTH):
            CUR_INDEX_MONTH = 0
            CUR_INDEX_YEAR += 1
            
        if (CUR_INDEX_YEAR > MAX_INDEX_GRAD_YEAR):
            CUR_INDEX_YEAR = 0

        if (CUR_INDEX_FIRST > MAX_INDEX_NAME_FIRST):
            CUR_INDEX_FIRST = 0
            CUR_INDEX_LAST += 1

        if (CUR_INDEX_LAST > MAX_INDEX_NAME_LAST):
            CUR_INDEX_LAST = 0

    #Append the appropriate data to our pre-existing data
    pData.append(firstName)
    pData.append(lastName)
    pData.append(gradDate)

    #Assume that all status updates are at their first revision
    pData.append(1)

    #Finally, give a numeric status update to the pre-existing data
    if (pData[9] == "UNK"):
        pData.append(0)
    elif (pData[9] == "IC"):
        pData.append(1)
    else:
        pData.append(2)


# This is the function that populates individual records from each line of data in the CSV file
def populate_output_secondary(pEntry, pData, pRecordType, pCSVSlot):

    #Create a temporary place counter and data storage unit
    counter = 0
    dataItem = ""
    temp = ""
    slot = 0

    #While our counter is less than length of this record type
    while (counter < DATA_TABLE_LENGTHS[pRecordType]):

        #Get the data item and pCSVSlot number
        dataItem = pData[pCSVSlot[counter]]
        slot = pCSVSlot[counter]

        #If this is a piece of data that needs to be formatted as a string
        if ( (slot == 0) or (slot == 2) or (slot == 5) or (slot == 8) or (slot == 11) or (slot == 15) or (slot == 16) or (slot == 17) ):

            #Prepend and append the data with \' before adding it to the entry
            dataItem = str(dataItem)
            temp = "\'" + dataItem + "\'"
            dataItem = temp

        #Fill in the entry slot with the appropriate CSV data slot and advance the counter
        pEntry.append(dataItem)
        counter += 1


# This is the function that begins data extraction from the CSV file and conversion into output .INSERT files
def populate_output_primary(pInFile, pOutFiles):

    #For some reason, the first line is an empty newline, so get rid of it now
    line = pInFile.readline()

    #Initialize our organized data list (it's a list of 10 lists, one list for each table)
    organizedData = [[],[],[],[],[],[],[],[],[],[]]

    #A counter to keep track of what type of record we're processing
    recordType = 0

    #For each line in our input file
    for line in pInFile:

        #print("\n\nOur current readline is " + line + ".\n\n")

        #Split data by commas and call the Generate Data function
        data = PATTERN.split(line)[1::2]
        generate_data(data)

        #For each slot in our organized data list
        for entry in organizedData:

            #Fill in the entry with data from our delimited data
            populate_output_secondary(entry, data, recordType, DATA_TABLE_CSV_SLOTS[recordType])

            #Advance to the next type of entry we need to fill in
            recordType += 1
            
        #After we've finished with this line of data, write it to the appropriate output .INSERT files
        write_output(organizedData, pOutFiles)

        #Then reset everything
        #print(organizedData)
        organizedData = [[],[],[],[],[],[],[],[],[],[]]
        recordType = 0
        data = None
    


# This is the function that initializes the .INSERT output files.
def initialize_output(pOutFiles):

    #Keep track of which file we're creating and writing to
    count = 0
    
    #For each file in our list of files
    for file in pOutFiles:

        #Create the final text value, print it for debugging purposes, and then write it to the current file
        txtFinal = "INSERT INTO " + TXT_TABLE_NAMES[count] + TXT_TABLE_ATTRIBUTES[count] + " VALUES "
        #print(txtFinal)
        file.write(txtFinal)

        #Advance the file counter to the next file
        count += 1



# ----------MAIN FUNCTION DECLARATION----------



# This is the main function from which all other functions are called. It also creates the files
# that will be used in all other functions and contains lists for auto-generating data.
def main():
    
    #Initialize our error flag to be False
    errorFlag = False
    
    #Create all the files we'll use to make the INSERT statements
    print("\nMaking files\n")
    outFiles = [open("outCrimeReport.txt", "w"), open("outCriminalIncident.txt","w"),
                open("outDefinedBy.txt", "w"), open("outFiledBy.txt", "w"),
                open("outMemberOf.txt", "w"), open("outPoliceDepartment.txt", "w"),
                open("outPoliceOfficer.txt", "w"), open("outReportedThrough.txt", "w"),
                open("outStatute.txt", "w"), open("outStatusUpdate.txt", "w")]

    #Close them, then reopen in APPEND mode
    for file in outFiles:
        file.close()

    print("\nRe-opening output files\n")
    outFiles = [open("outCrimeReport.txt", "a"), open("outCriminalIncident.txt","a"),
                open("outDefinedBy.txt", "a"), open("outFiledBy.txt", "a"),
                open("outMemberOf.txt", "a"), open("outPoliceDepartment.txt", "a"),
                open("outPoliceOfficer.txt", "a"), open("outReportedThrough.txt", "a"),
                open("outStatute.txt", "a"), open("outStatusUpdate.txt", "a")]

    #Open the input file that we'll use to make the INSERT statements and create a modified version
    inCSV = open("inCSV.txt", "r")
    inCSV2 = open("inCSV2.txt", "w")

    print("\nPrepping input file\n")
    #Replace all instances of ,, in inCSV with , , and write the result to inCSV2
    for line in inCSV:
        inCSV2.write(line.replace(",,", ", ,"))

    #Close both files, then reopen the new file (renamed as inCSV for simplicity) in READ mode
    inCSV.close()
    inCSV2.close()

    inCSV = open("inCSV2.txt", "r")

    #Initialize each of our output files
    print("\nPrepping output\n")
    initialize_output(outFiles)

    #Begin the primary function for reading data from our CSV file
    print("\nExtracting data\n")
    populate_output_primary(inCSV, outFiles)
    
    #Close all the files that contain our INSERT statements after capping off each output file with a ;
    for file in outFiles:
        file.write(";")
        file.close()

    #Also close the input file
    inCSV.close()
    
    #Report whether or not we encountered an error
    if (errorFlag == True):
        print("An error prevented this program from working properly\n")
    else:
        print("This program worked properly\n")
