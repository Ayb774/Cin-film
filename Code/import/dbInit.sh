


#!/bin/bash
 

# version pour importer que les 1000 premieres lignes 

DBNAME="sae_imdb"
PGHOST="localhost"
PGUSER="lks"
PGPASSWORD="lks"

PGPASSWORD="$PGPASSWORD" psql -U $PGUSER -d $DBNAME -h $PGHOST -c "\i ./tables.sql"


# Créez une fonction pour importer les données depuis un fichier
import_data(){

    local file_path=$1
    local table_name=$2

    PGPASSWORD="$PGPASSWORD" psql -U $PGUSER -d $DBNAME -h $PGHOST -c "\copy $table_name FROM '$file_path' WITH DELIMITER E'\t' QUOTE E'\b' CSV HEADER NULL '\N';"

    
}



path_data="./data/" 
for f in "$path_data"*.tsv; do 

			
        filename=$(basename -- "$f")
        table_name="${filename%.tsv}"  # Supprimer l'extension .tsv pour obtenir le nom de la table
        table_name=$(echo "$table_name" | tr -d '.')
        import_data $f $table_name
			
done



	





