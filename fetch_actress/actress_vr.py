from bs4 import BeautifulSoup
import csv
import requests
import re
import time
import random

out = open('actress_vr.csv', 'w', encoding="utf-8")
w = csv.writer(out)
w.writerow(['fanhao', 'actress'])
with open('urls_vr_revised.csv', encoding="utf-8")as csvFile:
    urls = csv.reader(csvFile)
    i = 0
    for url_list in urls:
        url = "".join(url_list[0])

        keep_request = True
        while keep_request:
            try:
                r = requests.get(url)
                keep_request = False

                # r = requests.get("https://www.javhoo.com/av/lzpl-052")
                # print(r.text)
                soup = BeautifulSoup(r.text, "html.parser")
                items = soup.find_all(href=re.compile(
                    "^https://www.javhoo.com/star/"))
                lists = []
                for item in items:
                    lists.append(item.getText())
                # print(lists)
                if i > 0:
                    w.writerow([url_list[1], lists])
                i += 1
                print(i, "/6773 done")
                # time.sleep(random.uniform(1,5))
            except:
                print(i,"/6773 reconnect rest for a sec")
                time.sleep(random.uniform(1,5))

out.close()
csvFile.close()
