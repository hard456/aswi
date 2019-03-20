CREATE TABLE translation ( 
   id SERIAL NOT NULL, 
   idf varchar(250) NOT NULL, -- jednozna�n� identifik�tor textu 
   language char(2) NOT NULL, -- dvoup�smenn� k�d jazyka 
   translation text NOT NULL, -- p�eklad 
   UNIQUE (language, idf), 
   PRIMARY KEY (id) 
);