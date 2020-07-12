from bs4 import BeautifulSoup
import csv
import requests
import re
import time
import random

c = input("input c: ")
c = c+'.csv'
ofname = 'actress_censored_part' + c
ifname = 'urls_censored_part' + c

if c == 'n.csv':
    total = 3040
else:
    total = 10000

out = open(ofname, 'w', encoding="utf-8")
w = csv.writer(out)
w.writerow(['fanhao', 'actress'])
with open(ifname, encoding="utf-8")as csvFile:
    urls = csv.reader(csvFile)
    i = 0
    for url_list in urls:
        url = "".join(url_list[0])

        keep_request = True
        while keep_request:
            try:
                r = requests.get(url)
                keep_request = False
                soup = BeautifulSoup(r.text, "html.parser")
                items = soup.find_all(href=re.compile(
                    "^https://www.javhoo.com/star/"))
                lists = []
                for item in items:
                    lists.append(item.getText())
                if i > 0:
                    w.writerow([url_list[1], lists])
                i += 1
                print(i, "/", total, " done")
            except:
                print(i, "/", total, " reconnect rest for a sec")
                time.sleep(random.uniform(1, 5))

out.close()
csvFile.close()
