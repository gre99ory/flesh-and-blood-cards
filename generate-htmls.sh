#!/bin/bash

pyenv exec csvtotable csvs/english/artist.csv web/artist.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/card.csv web/card.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/edition.csv web/edition.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/foiling.csv web/foiling.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/icon.csv web/icon.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/keyword.csv web/keyword.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/rarity.csv web/rarity.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/set.csv web/set.html -d $'\t' -q $'"' -o
pyenv exec csvtotable csvs/english/type.csv web/type.html -d $'\t' -q $'"' -o