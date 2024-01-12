#!/bin/bash 




url_array=("https://datasets.imdbws.com/name.basics.tsv.gz"
"https://datasets.imdbws.com/title.akas.tsv.gz"
"https://datasets.imdbws.com/title.basics.tsv.gz"
"https://datasets.imdbws.com/title.crew.tsv.gz"
"https://datasets.imdbws.com/title.episode.tsv.gz"
"https://datasets.imdbws.com/title.principals.tsv.gz"
"https://datasets.imdbws.com/title.ratings.tsv.gz")

for url in ${url_array[@]}; do

	if [ -d "./data" ] 
	then
	echo $url
   	wget $url -P ./data
  	else 
		echo $url
  		mkdir data 
  		wget $url -P ./data 
  	fi 


done

gzip -f -d ./data/*.gz
rm -f ./data/*.gz?.*


