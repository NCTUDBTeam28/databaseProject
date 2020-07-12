#include <iostream>
#include <string>
#include <fstream>
#include <sstream>

using namespace std;

int main()
{
    ifstream inFile("../data/actress_censored.csv", ios::in);
    ofstream outFile("../data/actress_censored_revised", ios::out);
    string line;
    int comacnt = 0;
    while (getline(inFile, line))
    {
        comacnt = 0;
        for (int i = 0; i < line.length(); i++)
        {

            if (line[i] == ',')
            {
                comacnt++;
                if (comacnt > 1)
                {
                    line.erase(i, 1);
                    i -= 1;
                }
            }
            else if ((line[i] == ']') || (line[i] == '[') || (line[i] == '\"') )
            {
                line.erase(i, 1);
                i -= 1;
            }
        }
        outFile << line << endl;
    }
}