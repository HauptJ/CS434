import csv
myfile = "CriminalIncident.txt"
mycsv = csv.reader(open(myfile))
for row in mycsv:
   text = row[1]
print text