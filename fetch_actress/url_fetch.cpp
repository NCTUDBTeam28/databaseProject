#include <iostream>
#include <fstream>
#include <iomanip>
#include <sstream>
#include <string>

using namespace std;

int main()
{
    // choose between uncensored.csv, censored.csv, vr.csv
    ifstream inFile("../data/uncensored.csv", ios::in);
    if (!inFile)
    {
        cout << "開啟檔案失敗！" << endl;
        exit(1);
    }

    int i = 0, j = 0, k = 'a';
    string line;
    string field;
    string fname = "urls_uncensored_part";

    while (!inFile.eof())
    {
        fname.push_back(k++);
        fname.push_back('.');
        fname.push_back('c');
        fname.push_back('s');
        fname.push_back('v');
        ofstream outFile(fname, ios::out);

        while (getline(inFile, line))
        {
            string field;
            istringstream sin(line);

            getline(sin, field, ',');
            getline(sin, field, ',');
            outFile << '"' << "https://www.javhoo.com/av/" << field.c_str() << '"' << "," << field.c_str() << endl;
            i++;
            j++;
            if(j == 10000)
                break;
        }

        outFile.close();
        cout << "寫入" << k << "完成" << endl;
        j = 0;
        fname = "urls_uncensored_part";
    }
    inFile.close();
    cout << "共讀取了：" << i << "行" << endl;
    cout << "讀取資料完成" << endl;
}
