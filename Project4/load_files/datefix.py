import csv
import datetime
myfile = "CriminalIncident.txt"
mycsv = csv.reader(open(myfile))
for line in mycsv:
	print line
	for row in mycsv:
		text = row[2]
