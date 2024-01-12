-- Supprimer la table titleakas si elle existe
DROP TABLE IF EXISTS titleakas CASCADE;

-- Supprimer la table titlebasics si elle existe
DROP TABLE IF EXISTS titlebasics CASCADE;

-- Supprimer la table titlecrew si elle existe
DROP TABLE IF EXISTS titlecrew CASCADE;

-- Supprimer la table titleepisode si elle existe
DROP TABLE IF EXISTS titleepisode CASCADE;

-- Supprimer la table titleprincipals si elle existe
DROP TABLE IF EXISTS titleprincipals CASCADE;


DROP TABLE IF EXISTS titleratings CASCADE;


DROP TABLE IF EXISTS namebasics CASCADE;


CREATE TABLE titlebasics (
  tconst VARCHAR ,
  titleType VARCHAR,
  primaryTitle VARCHAR,
  originalTitle VARCHAR,
  isAdult BOOLEAN,
  startYear INTEGER,
  endYear INTEGER,
  runtimeMinutes INTEGER,
  genres VARCHAR,
  PRIMARY KEY (tconst)
);


CREATE TABLE titleakas (
  titleId VARCHAR,
  ordering INTEGER,
  title VARCHAR,
  region VARCHAR,
  language VARCHAR,
  types VARCHAR,
  attributes VARCHAR,
  isOriginalTitle BOOL,
  PRIMARY KEY (titleID,ordering)

);


CREATE TABLE titlecrew (
  tconst VARCHAR,
  directors VARCHAR,
  writers VARCHAR,
  PRIMARY KEY (tconst)

);


CREATE TABLE titleepisode (
  tconst VARCHAR,
  parentTconst VARCHAR,
  seasonNumber INTEGER,
  episodeNumber INTEGER,
  PRIMARY KEY (tconst)

);

CREATE TABLE titleprincipals (
  tconst VARCHAR,
  ordering INTEGER,
  nconst VARCHAR,
  category VARCHAR,
  job VARCHAR,
  characters VARCHAR,
  PRIMARY KEY (tconst,ordering,nconst)

);

CREATE TABLE namebasics (
  nconst VARCHAR ,
  primaryName VARCHAR,
  birthYear INTEGER,
  deathYear VARCHAR,
  primaryProfession VARCHAR,
  knownForTitles VARCHAR,
  PRIMARY KEY (nconst) 
);


CREATE TABLE titleratings (
  tconst VARCHAR,
  averageRating NUMERIC(3, 1), -- Vous pouvez ajuster la précision en fonction de vos besoins
  numVotes INTEGER,
  PRIMARY KEY (tconst) 

);


