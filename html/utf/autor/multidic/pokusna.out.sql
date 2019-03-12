--
-- PostgreSQL database dump
--

SET client_encoding = 'UNICODE';
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'Standard public schema';


SET search_path = public, pg_catalog;

--
-- Name: plpgsql_call_handler(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION plpgsql_call_handler() RETURNS language_handler
    AS '$libdir/plpgsql', 'plpgsql_call_handler'
    LANGUAGE c;


ALTER FUNCTION public.plpgsql_call_handler() OWNER TO postgres;

--
-- Name: plpgsql_validator(oid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION plpgsql_validator(oid) RETURNS void
    AS '$libdir/plpgsql', 'plpgsql_validator'
    LANGUAGE c;


ALTER FUNCTION public.plpgsql_validator(oid) OWNER TO postgres;

--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: public; Owner: 
--

CREATE TRUSTED PROCEDURAL LANGUAGE plpgsql HANDLER plpgsql_call_handler VALIDATOR plpgsql_validator;


--
-- Name: database_size(name); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION database_size(name) RETURNS bigint
    AS '$libdir/dbsize', 'database_size'
    LANGUAGE c STRICT;


ALTER FUNCTION public.database_size(name) OWNER TO postgres;

--
-- Name: pg_database_size(oid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_database_size(oid) RETURNS bigint
    AS '$libdir/dbsize', 'pg_database_size'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_database_size(oid) OWNER TO postgres;

--
-- Name: pg_dir_ls(text, boolean); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_dir_ls(text, boolean) RETURNS SETOF text
    AS '$libdir/admin', 'pg_dir_ls'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_dir_ls(text, boolean) OWNER TO postgres;

--
-- Name: pg_file_length(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_length(text) RETURNS bigint
    AS $_$SELECT len FROM pg_file_stat($1) AS s(len int8, c timestamp, a timestamp, m timestamp, i bool)$_$
    LANGUAGE sql STRICT;


ALTER FUNCTION public.pg_file_length(text) OWNER TO postgres;

--
-- Name: pg_file_read(text, bigint, bigint); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_read(text, bigint, bigint) RETURNS text
    AS '$libdir/admin', 'pg_file_read'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_file_read(text, bigint, bigint) OWNER TO postgres;

--
-- Name: pg_file_rename(text, text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_rename(text, text, text) RETURNS boolean
    AS '$libdir/admin', 'pg_file_rename'
    LANGUAGE c;


ALTER FUNCTION public.pg_file_rename(text, text, text) OWNER TO postgres;

--
-- Name: pg_file_rename(text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_rename(text, text) RETURNS boolean
    AS $_$SELECT pg_file_rename($1, $2, NULL); $_$
    LANGUAGE sql STRICT;


ALTER FUNCTION public.pg_file_rename(text, text) OWNER TO postgres;

--
-- Name: pg_file_stat(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_stat(text) RETURNS record
    AS '$libdir/admin', 'pg_file_stat'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_file_stat(text) OWNER TO postgres;

--
-- Name: pg_file_unlink(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_unlink(text) RETURNS boolean
    AS '$libdir/admin', 'pg_file_unlink'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_file_unlink(text) OWNER TO postgres;

--
-- Name: pg_file_write(text, text, boolean); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_file_write(text, text, boolean) RETURNS bigint
    AS '$libdir/admin', 'pg_file_write'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_file_write(text, text, boolean) OWNER TO postgres;

--
-- Name: pg_logdir_ls(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_logdir_ls() RETURNS SETOF record
    AS '$libdir/admin', 'pg_logdir_ls'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_logdir_ls() OWNER TO postgres;

--
-- Name: pg_postmaster_starttime(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_postmaster_starttime() RETURNS timestamp without time zone
    AS '$libdir/admin', 'pg_postmaster_starttime'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_postmaster_starttime() OWNER TO postgres;

--
-- Name: pg_relation_size(oid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_relation_size(oid) RETURNS bigint
    AS '$libdir/dbsize', 'pg_relation_size'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_relation_size(oid) OWNER TO postgres;

--
-- Name: pg_reload_conf(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_reload_conf() RETURNS integer
    AS '$libdir/admin', 'pg_reload_conf'
    LANGUAGE c STABLE STRICT;


ALTER FUNCTION public.pg_reload_conf() OWNER TO postgres;

--
-- Name: pg_size_pretty(bigint); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_size_pretty(bigint) RETURNS text
    AS '$libdir/dbsize', 'pg_size_pretty'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_size_pretty(bigint) OWNER TO postgres;

--
-- Name: pg_tablespace_size(oid); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION pg_tablespace_size(oid) RETURNS bigint
    AS '$libdir/dbsize', 'pg_tablespace_size'
    LANGUAGE c STRICT;


ALTER FUNCTION public.pg_tablespace_size(oid) OWNER TO postgres;

--
-- Name: relation_size(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION relation_size(text) RETURNS bigint
    AS '$libdir/dbsize', 'relation_size'
    LANGUAGE c STRICT;


ALTER FUNCTION public.relation_size(text) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = true;

--
-- Name: author; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE author (
    "IDauthor" integer DEFAULT nextval('"autor_id_seq"'::text) NOT NULL,
    name character varying(100),
    surname character varying(100) NOT NULL
);


ALTER TABLE public.author OWNER TO jara;

--
-- Name: author_of_source; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE author_of_source (
    "IDsource" integer NOT NULL,
    "IDauthor" integer NOT NULL
);


ALTER TABLE public.author_of_source OWNER TO jara;

--
-- Name: autor_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE autor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.autor_id_seq OWNER TO jara;

--
-- Name: autor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('autor_id_seq', 1, false);


--
-- Name: context; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE context (
    "IDcontext" integer DEFAULT nextval('"context_id_seq"'::text) NOT NULL,
    orig_context character varying(255) NOT NULL,
    cz_context character varying(255) NOT NULL,
    en_context character varying(255) NOT NULL,
    source integer,
    voice integer
);


ALTER TABLE public.context OWNER TO jara;

--
-- Name: context_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE context_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.context_id_seq OWNER TO jara;

--
-- Name: context_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('context_id_seq', 1, false);


--
-- Name: dict; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE dict (
    "IDdict" integer DEFAULT nextval('"dict_id_seq"'::text) NOT NULL,
    czech character varying(50) NOT NULL,
    english character varying(50) NOT NULL,
    word_category character varying(50),
    verbal_class character varying(50),
    present character varying(50),
    past character varying(50),
    phrase character varying(50),
    impert character varying(50),
    valence character varying(50),
    root character varying(50),
    rezerve character varying(50),
    field integer,
    source integer,
    lection character varying(15),
    "language" integer NOT NULL,
    word_voice integer,
    usr integer,
    date_created timestamp with time zone NOT NULL,
    autorized integer,
    author integer,
    context integer
);


ALTER TABLE public.dict OWNER TO jara;

--
-- Name: dict_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE dict_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.dict_id_seq OWNER TO jara;

--
-- Name: dict_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('dict_id_seq', 822, true);


--
-- Name: exam; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE exam (
    "IDexam" integer DEFAULT nextval('"exam_id_seq"'::text) NOT NULL,
    examing integer,
    dict integer,
    status integer
);


ALTER TABLE public.exam OWNER TO jara;

--
-- Name: exam_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE exam_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.exam_id_seq OWNER TO jara;

--
-- Name: exam_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('exam_id_seq', 1250, true);


--
-- Name: examing; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE examing (
    "IDexaming" integer DEFAULT nextval('"examing_id_seq"'::text) NOT NULL,
    "user" integer,
    date timestamp with time zone,
    rating real,
    source integer,
    count integer,
    "type" character varying(7)
);


ALTER TABLE public.examing OWNER TO jara;

--
-- Name: COLUMN examing."type"; Type: COMMENT; Schema: public; Owner: jara
--

COMMENT ON COLUMN examing."type" IS 'mozne volby: from_cz, to_cz, from_en, to_en';


--
-- Name: examing_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE examing_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.examing_id_seq OWNER TO jara;

--
-- Name: examing_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('examing_id_seq', 29, true);


--
-- Name: field; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE field (
    "IDfield" integer DEFAULT nextval('"field_id_seq"'::text) NOT NULL,
    field character varying(100)
);


ALTER TABLE public.field OWNER TO jara;

--
-- Name: field_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE field_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.field_id_seq OWNER TO jara;

--
-- Name: field_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('field_id_seq', 1, false);


--
-- Name: language; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE "language" (
    "IDlanguage" integer DEFAULT nextval('"language_id_seq"'::text) NOT NULL,
    "language" character varying(25)
);


ALTER TABLE public."language" OWNER TO jara;

--
-- Name: language_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE language_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.language_id_seq OWNER TO jara;

--
-- Name: language_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('language_id_seq', 1, false);


--
-- Name: pg_logdir_ls; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW pg_logdir_ls AS
    SELECT a.filetime, a.filename FROM pg_logdir_ls() a(filetime timestamp without time zone, filename text);


ALTER TABLE public.pg_logdir_ls OWNER TO postgres;

--
-- Name: source; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE source (
    "IDsource" integer DEFAULT nextval('"source_id_seq"'::text) NOT NULL,
    title character varying(100) NOT NULL,
    subtitle character varying(100),
    place character varying(100),
    publication character varying(100),
    publication_no character varying(30),
    from_page integer,
    to_page integer,
    "language" integer,
    "year" character varying(4)
);


ALTER TABLE public.source OWNER TO jara;

--
-- Name: source_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE source_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.source_id_seq OWNER TO jara;

--
-- Name: source_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('source_id_seq', 1, true);


--
-- Name: user; Type: TABLE; Schema: public; Owner: jara; Tablespace: 
--

CREATE TABLE "user" (
    "IDuser" integer DEFAULT nextval('"user_id_seq"'::text) NOT NULL,
    name character varying(50) NOT NULL,
    surname character varying(50) NOT NULL,
    city character varying(70),
    email character varying(80),
    nationality character varying(40),
    number_of_usage integer,
    date_created timestamp with time zone NOT NULL,
    date_last_visit timestamp with time zone,
    "privileges" integer NOT NULL,
    nick character varying(20) NOT NULL,
    pass character varying(200) NOT NULL
);


ALTER TABLE public."user" OWNER TO jara;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: jara
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO jara;

--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jara
--

SELECT pg_catalog.setval('user_id_seq', 1, false);


--
-- Data for Name: author; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO author ("IDauthor", name, surname) VALUES (7, 'Jiří', 'Fleissig');
INSERT INTO author ("IDauthor", name, surname) VALUES (8, 'Charif', 'Bahbouh');
INSERT INTO author ("IDauthor", name, surname) VALUES (9, '', 'Krahl');
INSERT INTO author ("IDauthor", name, surname) VALUES (10, '', 'Reuschel');
INSERT INTO author ("IDauthor", name, surname) VALUES (12, 'Nea', 'Nováková');
INSERT INTO author ("IDauthor", name, surname) VALUES (13, 'Lukáš', 'Pecha');
INSERT INTO author ("IDauthor", name, surname) VALUES (14, 'Furat', 'Rahman');


--
-- Data for Name: author_of_source; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (6, 8);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (5, 7);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (7, 12);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (5, 8);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (6, 7);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (7, 13);
INSERT INTO author_of_source ("IDsource", "IDauthor") VALUES (7, 14);


--
-- Data for Name: context; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO context ("IDcontext", orig_context, cz_context, en_context, source, voice) VALUES (12, 'pokusny1للا؟ؤ', 'pokusny1', 'ffff', 0, NULL);


--
-- Data for Name: dict; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (10, '﻿nádraží', 'railway station', 's', '', '', 'مَحَطَّةٌ', NULL, NULL, 'مَحَطَّاتٌ', 'ḥṭṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:12.916+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (11, 'odejít', 'go away', 'v', 'I', 'إلَى', 'ذَهَبَ', NULL, NULL, 'يَذْهَبُ', 'ḏhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.076+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (12, 'nyní', 'now', 'a', '', '', 'اﻵنَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.106+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (13, 'otec', 'father', 's', '', '', 'أبٌ', NULL, NULL, 'آباءَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.136+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (14, 'vezmi to! m', 'take it! m', 'v', '', '', '', NULL, NULL, '!خُذ', 'ʾḫḏ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.156+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (15, 'vezmi to! f', 'take it! f', 'v', '', '', '', NULL, NULL, '!خُذِي', 'ʾḫḏ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.176+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (16, 'bratr', 'brother', 's', '', '', 'أَخٌ', NULL, NULL, 'إخْوَةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.206+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (17, 'sestra', 'sister', 's', '', '', 'أُخْتٌ', NULL, NULL, 'أخْواتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.226+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (18, 'země', 'earth', 's', '', '', 'أَرْضٌ', NULL, NULL, 'أَراضٍ', 'ʾrḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.246+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (19, 'Bůh', 'God', 's', '', '', 'أَلْلَهُ', NULL, NULL, '', 'ʾlh', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.276+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (20, 'při Bohu', 'by God', 'phr', '', '', 'وَٱلْلَه', NULL, NULL, '', 'ʾlh', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.306+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (21, 'do', 'to', 'prep', '', '', 'إلَى', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.326+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (22, 'matka', 'mother', 's', '', '', 'أُمٌّ', NULL, NULL, 'أُمَّهاةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.347+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (23, 'před', 'in front of', 'prep', '', '', 'أَمَامَ', NULL, NULL, '
', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.367+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (24, 'já', 'I', 'pron', '', '', 'أَنَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.387+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (25, 'ty m', 'you m', 'pron', '', '', 'أَنْتَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.427+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (26, 'ty f', 'you f', 'pron', '', '', 'أَنْتِ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.447+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (27, 'vy pl.m', 'you pl.m', 'pron', '', '', 'أَنْتُم', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.467+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (28, 'vy pl.f', 'you pl.f', 'pron', '', '', 'أَنْتُنَّ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.507+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (29, 'slečna', 'miss', 's', '', '', 'آنِسَةٌ', NULL, NULL, 'آنِسَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.527+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (30, 'zdravím Tě m', 'hello! m', 'phr', '', '', 'أَهْﻼًبِكَ', NULL, NULL, '', 'ʾhl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.547+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (31, 'zdravím Tě f', 'hello! f', 'phr', '', '', 'أَهْﻼًبِكِ', NULL, NULL, '', 'ʾhl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.567+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (32, 'vítejte!', 'welcome!', 'v', '', '', 'أهْﻼًوَسَهْﻻً', NULL, NULL, '', 'ʾhl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.587+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (33, 'tedy,také', 'also', 'adv', '', '', 'أَيْضًا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.607+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (34, 'kde', 'where', 'pron', '', '', 'أَيْنَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.647+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (35, 'Paříž', 'Paris', 's', '', '', 'بَارِيس', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.667+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (36, 'není to špatné', 'not bad', 'phr', '', '', 'ﻻ بَأَسَ', NULL, NULL, '', 'bʾs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.687+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (37, 'dveře', 'door', 's', '', '', 'بَابٌ', NULL, NULL, 'أبوَابٌ', 'bwb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.707+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (38, 'dům', 'house', 's', '', '', 'بَيْتٌ', NULL, NULL, 'بُيُوتٌ', 'byt', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.737+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (39, 'pod', 'under', 'prep', '', '', 'تَحْتَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.757+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (40, 'dolů', 'downwards', 'prep.', '', '', 'إلَى تَحْتَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.787+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (41, 'dobře', 'okay', 'phr', '', '', 'تَمَام', NULL, NULL, '', 'tmm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.807+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (42, 'nový', 'new', 'a', '', '', 'جَدِيدٌ', NULL, NULL, 'جُدُد', 'ğdd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.837+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (43, 'zeď', 'wall', 's', '', '', 'جِدَارٌ', NULL, NULL, 'جُدرَان', 'ğdr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.857+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (44, 'sedící', 'sitting', 's', '', '', 'جُلُوسٌ', NULL, NULL, '', 'ğls', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.897+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (45, 'krásný', 'beutiful', 'a', '', '', 'جَمِيلٌ', NULL, NULL, 'جَمِيلُونَ', 'ğml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.967+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (46, 'přístroj', 'device', 's', '', '', 'جِهَازٌ', NULL, NULL, 'أجْهِزَةٌ', 'ğhz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:13.997+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (47, 'televizor', 'tv-set', 's', '', '', 'جِهَاز تِلفِسيُون', NULL, NULL, '', 'ğhz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.017+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (48, 'video', 'video recorder', 's', '', '', 'جِهَاز فِيدِيُو', NULL, NULL, '', 'ğhz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.048+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (49, 'dobrý', 'good', 'a', '', '', 'جَيِّد', NULL, NULL, 'جَيِّدُونَ', 'ğyd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.068+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (50, 'zahrada', 'garden', 's', '', '', 'حَدِيقَةٌ', NULL, NULL, 'حَدَائِقُ', 'ḥdq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.098+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (51, 'písmeno', 'letter', 's', '', '', 'حَرْفٌ', NULL, NULL, 'حُرُوفٌ', 'ḥrf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.118+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (52, 'koupelna', 'bathroom', 's', '', '', 'حَمَّامٌ', NULL, NULL, 'حَمَّامَاتٌ', 'ḥmm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.148+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (53, 'Díky Bohu!', 'Thank God!', 'phr', '', '', 'ألْحَمْدُ لِلَّٰهِ', NULL, NULL, '', 'ḥmd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.168+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (54, 'stav', 'situation', 's', '', '', 'حَالٌ', NULL, NULL, 'أحْوَالٌ', 'ḥyl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.198+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (55, 'skříň', 'cupboard', 's', '', '', 'خِزَانَةٌ', NULL, NULL, 'خَزَائِنُ', 'ḫzn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.218+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (56, 'dobro', 'good', 'a', '', '', 'خَيْرٌ', NULL, NULL, '', 'ḫyr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.248+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (57, 'Jsem v pořádku', 'I am fine', 'phr', '', '', 'أَنَا بِخَيْرِ', NULL, NULL, '', 'ḫyr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.268+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (58, 'Nevím', 'I do not know', 'phr', '', '', 'أَنا ﻻ أَدْرِي', NULL, NULL, '', 'dry', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.288+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (59, 'rádio', 'radio', 's', '', '', 'رَادِيُو', NULL, NULL, 'رَادِيُوهَات', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.308+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (60, 'muž', 'man', 's', '', '', 'رَجُلٌ', NULL, NULL, 'رِجِالٌ', 'rğl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.348+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (61, 'Nazdar!', 'Hello!', 'phr', '', '', 'مَرهَباً', NULL, NULL, '', 'rḥb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.368+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (62, 'postel', 'bed', 's', '', '', 'سَرِيرٌ', NULL, NULL, 'أَسِرَّةٌ', 'srr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.388+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (63, 'strop', 'ceiling', 's', '', '', 'سَقْفٌ', NULL, NULL, 'سُقُوفٌ', 'sqf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.408+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (64, 'mír', 'peace', 's', '', '', 'سَﻼَم', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.448+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (65, 'Mír s vámi', 'Peace upon you', 'phr', '', '', 'ألسَّﻼَمُ عَلَيْكُم', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.508+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (66, 'S pozdravem!', 'So long!', 'phr', '', '', 'مَعَ ٱلسﻼَمَةِ', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.548+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (67, 'jméno', 'name', 's', '', '', 'اِسمٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.568+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (68, 'pán', 'Mr.', 's', '', '', 'سَيِّد', NULL, NULL, 'سَادَةٌ', 'syd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.588+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (69, 'paní', 'Mrs.', 's', '', '', 'سَيِّدَةٌ', NULL, NULL, 'سَيِّدَاتٌ', 'syd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.608+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (70, 'okno', 'window', 's', '', '', 'شُبَّاكٌ', NULL, NULL, 'شَبَابِيكُ', 'šbk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.648+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (71, 'Děkuji!', 'Thank you!', 'phr', '', '', 'شُكرًا', NULL, NULL, '', 'škr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.668+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (72, 'slunce', 'the Sun', 's', '', '', 'ألشَّمْسُ', NULL, NULL, '', 'šms', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.688+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (73, 'taška', 'bag', 's', '', '', 'شَنْطََةٌ', NULL, NULL, 'شُنَطٌ', 'šnṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.708+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (74, 'zdraví', 'health', 's', '', '', 'صَحَّةٌ', NULL, NULL, '', 'ṣḥḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.739+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (75, 'ráno', 'morning', 's', '', '', 'صَبَاحٌ', NULL, NULL, '', 'ṣbḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.779+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (76, 'Dobré ráno!', 'Good morning!', 'phr', '', '', 'ألسَّبَاحُ ٱلْخَيرِ', NULL, NULL, '', 'ṣbḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.799+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (77, 'lampa', 'lamp', 's', '', '', 'مِصْبَاحٌ', NULL, NULL, 'مَصَابِيحُ', 'ṣbḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.819+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (78, 'přítel', 'friend', 's', '', '', 'صَدِيقٌ', NULL, NULL, 'أَصْدِقَاءُ', 'ṣdq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.849+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (79, 'přítelkyně', 'friend', 's', '', '', 'صَدِيقَةٌ', NULL, NULL, 'صَدِيقَاتٌ', 'ṣdq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.869+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (80, 'malý', 'small', 'a', '', '', 'صَغِيرٌ', NULL, NULL, 'صِغَارٌ', 'ṣġr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.899+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (81, 'stůl', 'table', 's', '', '', 'طَاوِلَةٌ', NULL, NULL, 'طَاوِﻻَتٌ', 'twl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.959+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (82, 'lékař', 'doctor', 's', '', '', 'طَبِيبٌ', NULL, NULL, 'أطِبَّاءُ', 'ṭbb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.979+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (83, 'lékařka', 'doctor', 's', '', '', 'طَبِيبَةٌ', NULL, NULL, 'طَبِيبَاتٌ', 'ṭbb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:14.999+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (84, 'kuchyně', 'kitchen', 's', '', '', 'مَطْبَخٌ', NULL, NULL, 'مَطَابِخُ', 'ṭbḫ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.019+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (85, 'student', 'student', 's', '', '', 'طالِبٌ', NULL, NULL, 'ّ?طُﻼبٌ', 'ṭlb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.049+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (86, 'studentka', 'student', 's', '', '', 'طالِبَةٌ', NULL, NULL, 'طالِبَاتٌ', 'ṭlb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.089+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (87, 'dlouhý', 'long', 's', '', '', 'طَوِيلٌ', NULL, NULL, 'طِوَالٌ', 'ṭwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.109+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (88, 'dobře!', 'good!', 'phr', '', '', 'طَيِّب', NULL, NULL, 'طَيِّبُونَ', 'ṭyb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.129+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (89, 'promiňte!', 'pardon!', 'phr', '', '', 'عَفْوًا', NULL, NULL, '', 'ʿfw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.159+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (90, 'učitel', 'teacher', 's', 'm.', '', 'مُعَلِّمٌ', NULL, NULL, 'مُعَلِّمُونَ', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.179+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (91, 'učitelka', 'teacher', 's', 'f.', '', 'مُعَلِّمَةٌ', NULL, NULL, 'مُعَلِّمَاتٌ', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.209+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (92, 'na', 'upon', 'prep.', '', '', 'عَلَىٰ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.229+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (93, 'u', 'at', 'prep.', '', '', 'عِنْدَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.259+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (94, 'já mám', 'I have', 'phr, prep', '', '', 'عِنْدِي', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.279+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (95, 'rodina', 'familly', 's', '', '', 'عَائِلَةٌ', NULL, NULL, 'عَائِﻻَتٌ', 'ʿʾl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.299+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (96, 'místnost', 'room', 's', '', '', 'غُرْفَةٌ', NULL, NULL, 'غُرَفٌ', 'ġrf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.319+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (97, 'dívka', 'girl', 's', '', '', 'فَتَاةُ', NULL, NULL, 'فَتَيَاتٌ', 'fty', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.359+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (98, 'Fátima', 'Fatima', 's', '', '', 'فَاطِمَةُ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.379+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (99, 'na', 'on top of', 'prep.', '', '', 'فَوْقَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.399+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (100, 'nahoru', 'on top of', 'prep.', '', '', 'إِلٰى فَوْقَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.419+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (101, 'v', 'in', 'prep.', '', '', 'فِي', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.45+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (102, 'starý', 'old', 'adv', '', '', 'قَدِيمٌ', NULL, NULL, 'قُدْمَاءُ', 'qdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.49+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (103, 'postup', 'progress', 's', 'V', '', 'تَقْدُّم', NULL, NULL, '', 'qdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.51+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (104, 'krátký', 'short', 'a', '', '', 'قَصِيرٌ', NULL, NULL, 'قِصَارٌ', 'qṣr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.53+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (105, 'pero', 'pencil', 's', '', '', 'قَلَمٌ', NULL, NULL, 'أَقْﻼَمٌ', 'qlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.56+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (106, 'Měsíc', 'the Moon', 's', '', '', 'قَمَرٌ', NULL, NULL, '', 'qmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.58+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (107, 'Káhira', 'Cairo', 's', '', '', 'أَلْقَاهِرَةُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.60+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (108, 'velký', 'big', 'adv', '', '', 'كَبِيرٌ', NULL, NULL, 'كِبَارٌ', 'kbr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.64+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (109, 'kniha', 'book', 's', '', '', 'كِتَابٌ', NULL, NULL, 'كُتُبٌ', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.67+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (110, 'sešit', 'notebook', 's', '', '', 'كُرَّاسَةٌ', NULL, NULL, 'كَرَارِيسُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.69+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (111, 'židle', 'chair', 's', '', '', 'كُرْسِيٌ', NULL, NULL, 'كَرَاسِيٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.71+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (112, 'telefonní hovor', 'phone call', 's', '', '', 'مُكَالَمَةٌ تِلِفُنِيٌّ', NULL, NULL, '', 'klm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.73+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (113, 'jak', 'how', 'prep.', '', '', 'كَيْفَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.76+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (114, 'Jak se máš', 'How are you', 'phr', '', '', 'كَيْفَ حَالُك', NULL, NULL, '', 'ḥwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.80+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (115, 'pro', 'for', 'prep', '', '', 'لِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.82+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (116, 'pro mne', 'for me', 'phr', '', '', 'لِي', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.84+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (117, 'ne', 'no', 'p', '', '', 'ﻻَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.87+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (118, 'Na viděnou', 'So long!', 'phr', '', '', 'إلَىٰ ٱلْلِقَاءِ', NULL, NULL, '', 'lqy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.90+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (119, 'tabule', 'blackboard', 's', '', '', 'لَوْحٌ', NULL, NULL, 'أَلوَاحٌ', 'lwḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.93+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (120, 'co', 'what', 'IP', '', '', 'مَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.96+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (121, 'co', 'what', 'IP', '', '', 'مَاذِا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:15.98+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (122, 'kdy', 'when', 'IP', '', '', 'مَتَىٰ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (123, 'město', 'city', 's', '', '', 'مَدِينَةٌ', NULL, NULL, 'مُدُنٌ', 'mdn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.02+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (124, 'odpoledne', 'evening', 's', '', '', 'مَسَاءٌ', NULL, NULL, '', 'msʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.05+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (125, 'Dobré odpoledne!', 'Good evening!', 'phr', '', '', 'مَسَاءُ ٱلْخَيْرِ', NULL, NULL, '', 'msʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.08+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (126, 's', 'with', 'prep', '', '', 'مَعَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.10+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (127, 'kdo', 'who', 'pron', '', '', 'مَن', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.12+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (128, 'z', 'out of', 'prep.', '', '', 'مِن', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.141+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (129, 'my', 'we', 'pron', '', '', 'نَحْنُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.171+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (130, 'čistý', 'clean', 'adv', '', '', 'نَظِيفٌ', NULL, NULL, 'نُظَفَاءُ', 'nẓf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.211+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (131, 'ano', 'yes', 'phr', '', '', 'نَعَم', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.231+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (132, 'spánek', 'sleep', 's', '', '', 'نَوْمٌ', NULL, NULL, '', 'nwm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.251+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (133, 'Haló!', 'Hello!', 'phr', '', '', 'هَلُّو', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.281+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (134, 'tento', 'this', 'pron', '', '', 'هٰذَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.301+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (135, 'tato', 'that', 'pron', '', '', 'هٰذِهِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.321+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (136, 'Dej!', 'Give!', 'phr', '', '', 'هَات', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.361+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (137, 'tázací částice', 'interrogative particle', 'IP', '', '', 'هَل', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.391+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (138, 'oni', 'they', 'pron', '', '', 'هُمْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.411+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (139, 'ony', 'they', 'pron', '', '', 'هُنَّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.431+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (140, 'zde', 'here', 'adv', '', '', 'هُنَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.451+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (141, 'tam', 'there', 'adv', '', '', 'هُنَاكَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.481+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (142, 'on', 'he', 'pron', '', '', 'هُوَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.521+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (143, 'ona', 'she', 'pron', '', '', 'هِيَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.541+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (144, 'a', 'and', 'conj', '', '', 'وَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.561+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (145, 'nachází se', 'there is', 'phr', '', '', 'يُوجَدُ', NULL, NULL, '', 'wğd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.591+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (146, 'papír', 'paper', 's', '', '', 'وَرَقَ', NULL, NULL, 'أَورَاقٌ', 'wrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.611+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (147, 'špinavý', 'dirty', 'a', '', '', 'وَسِخٌ', NULL, NULL, '', 'wsḫ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.651+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (148, 'japonský', 'Japanese', 'a', '', '', 'يَابَانِيٌ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.681+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (149, 'jídlo', 'meal,dish', 's', '', '', 'أَكْلَةٌ', NULL, NULL, 'أكْﻻَتٌ', 'ʾkl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.701+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (150, 'emirát', 'emirate', 's', '', '', 'إِمارَةٌ', NULL, NULL, 'إِمَارَاتٌ', 'ʾmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.721+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (151, 'tatínek', 'daddy', 's', '', '', 'بَابَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.741+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (152, 'autobus', 'bus', 's', '', '', 'بَاصٌ', NULL, NULL, 'بَاصَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.771+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (153, 'lednička', 'refrigerator', 's', '', '', 'بَرَّادَةٌ', NULL, NULL, 'بَرَّادَاتٌ', 'brd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.811+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (154, 'po', 'after', 'prep.', '', '', 'بَعْدَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.832+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (155, 'země', 'country', 's', '', '', 'بَلَدٌ', NULL, NULL, 'بُلْدَانُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.852+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (156, 'vejce', 'eggs', 's', '', '', 'بَيْضٌ', NULL, NULL, '', 'byḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.882+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (157, 'přelož', 'translate', 'v', '', '', 'تَرْجِم', NULL, NULL, 'تَرْجِمِي', 'trğm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.912+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (158, 'Tunisko,Tunis', 'Tunisia,Tunis', 's', '', '', 'تُونِسُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.952+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (159, 'sýr', 'cheese', 's', '', '', 'جُبْنَةٌ', NULL, NULL, '', 'ğbn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:16.982+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (160, 'Alžírsko', 'Algeria', 's', '', '', 'أَاجَزَائِرُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.002+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (161, 'univerzita', 'university', 's', '', '', 'جَامِعَةٌ', NULL, NULL, 'جَامِعَاتٌ', 'ğmʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.022+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (162, 'pilný', 'diligent', 'adj', 'VIII', '', 'مُجْتَهِدٌ', NULL, NULL, 'مُجْتَهِدُونَ', 'ğhd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.042+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (163, 'obchod', 'shop', 's', '', '', 'مَحَلٌّ', NULL, NULL, 'مَحَﻻَتٌ', 'ḥll', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.062+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (164, 'mléko', 'milk', 's', '', '', 'حَلِيبٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.112+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (165, 'chleba', 'bread', 's', '', '', 'خُبْزٌ', NULL, NULL, '', 'ḫbz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.132+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (166, 'pekařství', 'bakery', 's', '', '', 'مَخْبَزٌ', NULL, NULL, 'مَخَابِزُ', 'ḫbz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.152+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (167, 'obchod', 'shop', 's', '', '', 'مَخْزَنُ', NULL, NULL, 'مَخَازِنُ', 'mḫz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.182+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (168, 'zelenina', 'vegetables', 's', '', '', 'خَضْرَاوَاتٌ', NULL, NULL, '', 'ḫḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.202+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (169, 'škola', 'school', 's', '', '', 'مَدْرَسَةٌ', NULL, NULL, 'مَدَارِسُ', 'drs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.222+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (170, 'obchod', 'shop', 's', '', '', 'دُكَّانٌ', NULL, NULL, 'دَكَاكِينُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.252+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (171, 'jdu do', 'I go to', 'phr', '', '', 'أَذْهَبُ إِلَى', NULL, NULL, '', 'ḍhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.272+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (172, 'marmeláda', 'marmelade', 's', '', '', 'مُرَبَّىً', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.302+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (173, 'máslo', 'butter', 's', '', '', 'زُبْدَةٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.322+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (174, 'Saudská Arábie', 'Saudi Arabia', 's', '', '', 'أَاسَّعُودِيَةُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.342+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (175, 'cukr', 'sugar', 's', '', '', 'سُكَّر', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.382+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (176, 'Sudán', 'Sudan', 's', '', '', 'أَاسُّودَانُ', NULL, NULL, '', 'swd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.412+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (177, 'Sýrie', 'Syria', 's', '', '', 'سُورِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.432+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (178, 'trh', 'market', 's', '', '', 'سُوقٌ', NULL, NULL, 'أَسْوَاقٌ', 'swq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.452+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (179, 'auto', 'car', 's', '', '', 'سَيَّارَةٌ', NULL, NULL, 'سَيَّارَاتٌ', 'syr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.472+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (180, 'čaj', 'tea', 's', '', '', 'شَايٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.502+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (181, 'nápoje', 'drinks', 's', '', '', 'مَشْرُوبَاتٌ', NULL, NULL, '', 'šrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.543+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (182, 'ulice', 'street', 's', '', '', 'شَارِع', NULL, NULL, 'شَوَارِعُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.563+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (183, 'správně', 'right,correct', 'a', '', '', 'صَحِيحٌ', NULL, NULL, '', 'ṣḥḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.583+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (184, 'letiště', 'airport', 's', '', '', 'مَطَارٌ', NULL, NULL, 'مَطَارَاتٌ', 'tyr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.613+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (185, 'letadlo', 'air-plane', 's', '', '', 'طَائِرَةٌ', NULL, NULL, 'طَائِرَاتٌ', 'tyr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.633+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (186, 'Irák', 'Iraq', 's', '', '', 'أَلْعِرَاقُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.653+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (187, 'med', 'honey', 's', '', '', 'عَسَلٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.703+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (188, 'džus', 'juice', 's', '', '', 'عَصِيرٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.723+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (189, 'hlavní město', 'capital city', 's', '', '', 'عَاصِمَةٌ', NULL, NULL, 'عُوَاصِمُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.763+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (190, 'veliký', 'great', 'adv', '', '', 'عَظِيمٌ', NULL, NULL, 'عُظْمَاءُ', 'ʿẓm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.793+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (191, 'Omán', 'Oman', 's', '', '', 'عُمَانُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.823+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (192, 'Opakuj', 'Repeat', 'phr', '', '', 'أَعِدْ', NULL, NULL, '', 'ʿwd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.843+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (193, 'oběd', 'lunch', 's', '', '', 'غَدَاءٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.863+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (194, 'Maghrib', 'Maghreb', 's', '', '', 'أَلْمَغْرِب', NULL, NULL, '', 'ġrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.913+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (195, 'chyba', 'mistake', 's', '', '', 'غَلِطٌ', NULL, NULL, 'أَغْﻼَطٌ', 'ġlṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:17.973+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (196, 'snídaně', 'breakfast', 's', '', '', 'فُطُورٌ', NULL, NULL, '', 'fṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.003+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (197, 'ovoce', 'fruits', 's', '', '', 'فَاكِهَةٌ', NULL, NULL, 'فَوَاكِهٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.023+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (198, 'vlak', 'train', 's', '', '', 'قِطَارٌ', NULL, NULL, 'قِطَارَاتٌ', 'qṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.043+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (199, 'málo', 'few', 's', '', '', 'قَلِيلٌ', NULL, NULL, 'قَلِيلُونَ', 'qll', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.083+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (200, 'káva', 'coffee', 's', '', '', 'قَهْوَةٌ', NULL, NULL, '', 'qhw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.113+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (201, 'knihkupectví', 'bookshop', 's', '', '', 'مَكْتَبَةٌ', NULL, NULL, 'مَكْتَبَاتٌ', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.133+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (202, 'četný', 'many', 'a', '', '', 'كَثِيرٌ', NULL, NULL, 'كِثَارٌ', 'kṯr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.153+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (203, 'počítač', 'computer', 's', '', '', 'كُمْبُيُوتَرٌ', NULL, NULL, 'كُمْبُيُوتَرَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.173+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (204, 'Kuvajt', 'Kuwait', 's', '', '', 'أَلْكُوَيتُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.203+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (205, 'šaty', 'clothes', 's', '', '', '', NULL, NULL, 'مَﻼَبِسُ', 'lbs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.244+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (206, 'Lýbie', 'Libya', 's', '', '', 'لِيبِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.264+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (207, 'například', 'for example', 'phr', '', '', 'مَثَﻼً', NULL, NULL, '', 'mṯl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.284+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (208, 'Egypt', 'Egypt', 's', '', '', 'مِصْرُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.314+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (209, 'Jemen', 'Yemen', 's', '', '', 'أَلْيَمَنُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.334+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (210, 'den', 'day', 's', '', '', 'يَوْمٌ', NULL, NULL, 'أيَّامٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.354+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (211, 'dnes', 'today', 'adv', '', '', 'ألْيَوْمَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.394+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (212, 'Němec', 'German', 's', '', '', 'أَلْمَانِيٌ', NULL, NULL, 'أَلْمَانٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.424+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (213, 'nebo', 'or', 'conj', '', '', 'أَمْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.444+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (214, 'to znamená', 'that is', 'phr', '', '', 'أَيْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.464+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (215, 'předložka pro opis českého 7.pádu', 'with', 'prep.', '', '', 'بِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.484+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (216, 'Gratuluji!', 'Congratulations!', 'phr', '', '', 'مُبَارَك', NULL, NULL, '', 'brk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.514+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (217, 'velmi', 'very', 'a', '', '', 'جِدًّا', NULL, NULL, '', 'ǧdd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.544+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (218, 'kůže', 'leather', 's', '', '', 'جِلْدٌ', NULL, NULL, '', 'ǧld', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.574+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (219, 'inkoust', 'ink', 's', '', '', 'حِبْرٌ', NULL, NULL, '', 'ḥbr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.594+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (220, 'moderní', 'modern', 'Adv', '', '', 'حَدِيثٌ', NULL, NULL, 'حِدَاثٌ', 'ḥdṯ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.624+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (221, 'zastávka autobusu', 'bus-stop', 's', '', '', 'مَحَطَّةُ ٱلْبَاصَات', NULL, NULL, '', 'ḥṭṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.644+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (222, 'lekce', 'lesson', 's', '', '', 'دَرْسٌ', NULL, NULL, 'دُرُوسٌ', 'drs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.684+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (223, 'studium', 'study', 's', '', '', 'دِرَاسَةٌ', NULL, NULL, 'دِرَاسَاتٌ', 'drs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.714+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (224, 'šel jsem', 'I went', 'phr', '', '', 'ذَهَبْتُ', NULL, NULL, '', 'ḏhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.734+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (225, 'šel jsi', 'you went', 'phr', '(m.)', '', 'ذَهَبتَ', NULL, NULL, '', 'ḏhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.754+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (226, 'šla jsi', 'you went', 'phr', '(f.)', '', 'ذَهَبْتِ', NULL, NULL, '', 'ḏhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.774+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (227, 'viděl jsem', 'I saw', 'phr', '', '', 'رَأَيْتُ', NULL, NULL, '', 'rʾy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.794+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (228, 'viděl jsi', 'you saw', 'phr', '(m.)', '', 'رَأَيْتَ', NULL, NULL, '', 'rʾy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.834+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (229, 'viděla jsi', 'you saw', 'phr', '(f.)', '', 'رَأَيْتِ', NULL, NULL, '', 'rʾy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.864+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (230, 'vhodný', 'convenient', 'a', '', '', 'مُرِيحٌ', NULL, NULL, '', 'ryḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.894+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (231, 'román', 'novel', 's', '', '', 'رِوَايَةٌ', NULL, NULL, 'رِوَايَاتٌ', 'rwy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.945+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (232, 'pravítko', 'ruler', 's', '', '', 'مِسْطَرَةٌ', NULL, NULL, 'مَسَاطِرُ', 'sṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.965+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (233, 'strom', 'tree', 's', '', '', 'شَجَرَةٌ', NULL, NULL, 'أَشجَارٌ', 'šǧr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:18.985+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (234, 'koupil jsem', 'I bought', 'phr', '', '', 'اِشْتَرَيْتُ', NULL, NULL, '', 'šry', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.025+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (235, 'koupil jsi', 'you bought', 'phr', 'm.', '', 'اِشْتَرَيْتَ', NULL, NULL, '', 'šry', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.055+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (236, 'koupila jsi', 'you bought', 'phr', 'f.', '', 'اِشْتَرَيْتِ', NULL, NULL, '', 'šry', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.075+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (237, 'chytrý', 'clever', 'Adv', '', '', 'شَاطِرٌ', NULL, NULL, 'شُطَّارٌ', 'šṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.095+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (238, 'lékařství', 'medicine', 's', '', '', 'طِبٌّ', NULL, NULL, '', 'ṭbb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.115+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (239, 'cesta', 'road', 's', '', '', 'طَرِيقٌ', NULL, NULL, 'طُرُقٌ', 'ṭrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.145+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (240, 'množství', 'number', 's', '', '', 'عَدَد', NULL, NULL, 'أَعْدَاد', 'ʿdd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.175+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (241, 'Arabský', 'Arab', 's', '', '', 'عَرَبِيٌ', NULL, NULL, 'عَرَبٌ', 'ʿrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.195+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (242, 'to jest', 'that means', 'phr', '', '', 'يَعَنِي', NULL, NULL, '', 'ʿny', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.225+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (243, 'rozuměl jsem', 'I understood', 'phr', '', '', 'فَهِمْتُ', NULL, NULL, '', 'fhm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.245+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (244, 'rozuměl jsi', 'you understood', 'phr', 'm.', '', 'فَهِمْتَ', NULL, NULL, '', 'fhm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.265+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (245, 'rozuměla jsi', 'you understood', 'phr', 'f.', '', 'فَهِمْتِ', NULL, NULL, '', 'fhm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.305+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (246, 'slovník', 'dictionary', 's', '', '', 'قَامُوسٌ', NULL, NULL, 'قَوَامِيسُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.335+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (247, 'přibližně', 'nearly', 'a', '', '', 'تَقْرِيبًا', NULL, NULL, '', 'qrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.355+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (248, 'napsal jsem', 'I wrote', 'phr', '', '', 'كَتَبْتُ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.375+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (249, 'napsal jsi', 'you wrote', 'phr', 'm.', '', 'كَتَبْتَ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.395+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (250, 'napsala jsi', 'you wrote', 'phr', 'f.', '', 'كَتَبْتِ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.425+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (251, 'psaní', 'writing', 's', '', '', 'كِتَابَةٌ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.475+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (252, 'píšící(spisovatel)', 'writer', 's', '', '', 'كَاتِبٌ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.525+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (253, 'napsaný(mn.č. dopisy)', 'written', 's', '', '', 'مَكْتُوبٌ', NULL, NULL, 'مَكَاتِبٌ', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.565+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (254, 'fakulta', 'faculty', 's', '', '', 'كُلِّيَةٌ', NULL, NULL, 'كُلِّيَاتٌ', 'kly', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.585+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (255, 'guma', 'eraser', 's', '', '', 'مِمحَاةٌ', NULL, NULL, '', 'mḥy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.616+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (256, 'vlevo', 'left(side)', 's', '', '', 'يِسَارٌ', NULL, NULL, '', 'ysr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.646+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (257, 'nalevo', 'to the left', 's', '', '', 'إلَى ٱلْيِسَارِ', NULL, NULL, '', 'ysr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.666+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (258, 'vpravo', 'right(side)', 's', '', '', 'يَمِينٌ', NULL, NULL, '', 'ymn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.686+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (259, 'napravo', 'to the right', 's', '', '', 'إلَى ٱلْيَمِينِ', NULL, NULL, '', 'ymn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.706+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (260, 'jiný, ostatní m', 'other m', 'pron', '', '', 'آخَرُ', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.736+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (261, 'jiná f', 'other f', 'pron', '', '', 'أُخْرىَٰ', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.766+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (262, 'Španělsko', 'Spain', 's', '', '', 'إِسْبَانِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.786+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (263, 'jíst', 'to eat', 'v', 'I', '', 'أَكَلَ', NULL, NULL, 'يَأَكُلُ', 'ʾkl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.806+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (264, 'Německo', 'Germany', 's', '', '', 'أَلمَانِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.826+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (265, 'včera', 'yesterday', 'a', '', '', 'أَمْسِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.856+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (266, 'že', 'that', 'conj', '', '', 'أَنَّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:19.906+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (267, 'rodiče, příbuzní', 'family, relatives', 's', '', '', 'أَهْلٌ', NULL, NULL, 'أَهَالٍ', 'ʾhl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.026+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (268, 'Portugalsko', 'Portugal', 's', '', '', 'البُرْتُغَالُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.056+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (269, 'program', 'program', 's', '', '', 'بَرْنَامِجٌ', NULL, NULL, 'بَرَامِجُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.076+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (270, 'Velká Británie', ' Great Britain', 's', '', '', 'بْرِيَطَانِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.096+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (271, 'poté co', 'after that', 'adv', '', '', 'بَعَدَ ذٰلِكَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.116+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (272, 'Belgie', 'Belgium', 's', '', '', 'بِلْجِيكَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.146+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (273, 'Polsko', 'Poland', 's', '', '', 'بُولَْندَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.176+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (274, 'mezi dvěma', 'among, between', 'prep', '', '', 'بَيْنَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.196+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (275, 'obchod', 'trade', 's', '', '', 'تِجَارَةٌ', NULL, NULL, 'تِجَارِيٌ', 'tğr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.216+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (276, 'obchodník', 'trader', 's', '', '', 'تَاجِرٌ', NULL, NULL, 'تُجَّارٌ', 'tğr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.246+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (277, 'turecký', 'Turkish', 'a', '', '', 'تُرْكِيٌ', NULL, NULL, 'أَتْرَاكٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.266+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (278, 'unavený', 'tired, exhausted, ill', 'a', '', '', 'تَعْبَانُ', NULL, NULL, '', 'tʿb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.297+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (279, 'setkání', 'meeting', 's', 'VIII', '', 'اِجْتِمَاعٌ', NULL, NULL, 'اِجْتِمَاعَاتٌ', 'ğmʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.317+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (280, 'zpráva', 'news', 's', '', '', 'خَبَرٌ', NULL, NULL, 'أَخْبَارٌ', 'ḫbr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.347+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (281, 'odejít z', 'to exit, to leave', 'v', 'I', 'مِن', 'خَرَجَ', NULL, NULL, 'يَخْرُجُ', 'ḫrğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.367+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (282, 'Německo', 'Denmark', 's', '', '', 'الدِّنْمَارْكُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.387+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (283, 'disko', 'disco', 's', '', '', 'دِيسْكُو', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.417+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (284, 'tamten, onen', 'that', 'pron', '', '', 'ذٰلِكَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.437+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (285, 'dopis, poselství', 'letter', 's', '', '', 'رِسَالَةٌ', NULL, NULL, 'رَسَائِلُ', 'rsl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.467+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (286, 'tančit', 'to dance', 'v', 'I', '', 'رَقَصَ', NULL, NULL, 'يَرْقُصُ', 'rqṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.487+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (287, 'taneční hala', 'dance hall', 's', '', '', 'مَرْقَصٌ', NULL, NULL, 'مَرَاقِصُ', 'rqṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.507+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (288, 'centrum', 'center', 's', '', '', 'مَرْكَزٌ', NULL, NULL, 'مَرَاكِزُ', 'rkz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.527+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (289, 'Rusko', 'Russia', 's', '', '', 'رُوسِيَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.567+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (290, 'ptát se', 'to ask about', 'v', 'I', 'عَنْ', 'سَأَلَ', NULL, NULL, 'يَسْأَلُ', 'sʾl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.587+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (291, 'já jsem se ho zeptala', 'I asked him', 'phr', '', '', 'سَأَلْتُهُ', NULL, NULL, '', 'sʾl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.607+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (292, 'cestovat', 'to travel', 'v', 'III', '', 'سَافَرَ', NULL, NULL, 'يُسَافِرُ', 'sfr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.627+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (293, 'pozdravuj', 'regards to', 'phr', '', '', 'سَلِّمْ عَلَى', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.657+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (294, 'pozdravuj ho ode mne', 'give my regards to so', 'phr', '', '', 'سَلِّمْ لِي عَلَى', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.677+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (295, 'pozdravuj ho ode mne', 'give my regards to so (fem.)', 'phr', '', '', 'سَلِّمِي لِي عَلَى', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.707+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (296, 'slyšet', 'to hear so.,sth.', 'v', 'I', 'ه', 'سَمِعَ', NULL, NULL, 'يَسْمَعَ', 'smʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.727+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (297, 'politika', 'politics', 's', '', '', 'سِيَاسَةٌ', NULL, NULL, '', 'sys', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.757+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (298, 'politický, politik', 'political, politician', 's, adv', '', '', 'سِيَاسِيٌّ', NULL, NULL, 'سِيَاسِيُّونَ', 'sys', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.777+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (299, 'Zuzana', 'Susan', 's', '', '', 'سُوسَن', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.797+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (300, 'Švédsko', 'Sweden', 's', '', '', 'السُّوِيدُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.827+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (301, 'Švýcarsko', 'Switzerland', 's', '', '', 'سْوِيسْرَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.857+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (302, 'pít', 'to drink sth.', 'v', 'I', 'ه', 'شَرِبَ', NULL, NULL, 'يَشْرَبُ', 'šrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.877+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (303, 'východní, orientalní', 'eastern, oriental', 'adj', '', '', 'شَرْقِيٌّ', NULL, NULL, '', 'šrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.917+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (304, 'společnost', 'firm, enterprise, company', 's', '', '', 'شَرِكَةٌ', NULL, NULL, 'شَرِكَاتٌ', 'šrk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.947+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (305, 'kalendářní měsíc', 'month', 's', '', '', 'شَهْرٌ', NULL, NULL, 'شُهُورٌ/أَشْهُرٌ', 'šhr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:20.977+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (306, 'věc, něco', 'thing, matter', 's', '', '', 'شَيْءٌ', NULL, NULL, 'أَشْيَاءٌ', 'šjʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.008+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (307, 'dobrou noc', 'may you be well tomorrow', 'phr', '', '', 'تُصْبَحُ عَلَى خَيْرٍ', NULL, NULL, 'sbḥ', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.028+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (308, 'dobrou noc', 'may you be well tomorrow (fem.)', 'phr', '', '', 'تُصْبِح ?بِ/ عَلَى خَيْرٍ', NULL, NULL, '', 'sbḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.058+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (309, 'totéž tobě', 'the same to you', 'phr', '', '', 'وَ أَنْتَ مِنْ أَهْلِهِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.078+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (310, 'totéž tobě', 'the same to you (fem.)', 'phr', '', '', 'وَ أَنْتِ مِنْ أَهْلِهِ', NULL, NULL, '', 'sbḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.098+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (311, 'lékárník, lékárna', 'pharmacist', 's', '', '', 'صَيْدَلِيٌّ', NULL, NULL, 'صَيَادِلَةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.118+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (312, 'jídlo', 'meal', 's', '', '', 'طَعَامٌ', NULL, NULL, 'أَطْعِمَةٌ', 'ṭʿm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.158+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (313, 'znát někoho', 'to know so., sth.', 'v', 'I', 'ه', 'عَرَفَ', NULL, NULL, 'يَعْرِفُ', 'ʿrf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.178+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (314, 'uspořádat, uzavřít', 'to hold (conference), to make a contract', 'v', 'I', 'ه', 'عَقَدَ', NULL, NULL, 'يَعْقِدُ', 'ʿqd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.198+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (315, 'vztah', 'relation', 's', '', '', 'عَﻻقَةٌ', NULL, NULL, 'عَﻻقَاتٌ', 'ʿlq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.218+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (316, 'památky, pamětihodnosti', 'sites', 's', '', '', 'مَعَالِمُ ج', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.238+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (317, 'pracovat', 'to work', 'v', 'I', '', 'عَمِلَ', NULL, NULL, 'يَعْمَلُ', 'ʿml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.268+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (318, 'práce', 'work', 's', '', '', 'عَمَلٌ', NULL, NULL, 'أَعْمَالٌ', 'ʿml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.298+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (319, 'od, po', 'about, over', 'prep', '', '', 'عَنْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.318+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (320, 'Francie', 'France', 's', '', '', 'فِرَنْسَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.338+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (321, 'dělat', 'to do sth.', 'v', 'I', 'ه', 'فَعَلَ', NULL, NULL, 'يَفْعَلُ', 'fʿl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.368+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (322, 'myšlenka, nápad', 'idea', 's', '', '', 'فِكْرَةٌ', NULL, NULL, 'أَفْكَارٌ', 'fkr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.388+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (323, 'hotel', 'hotel', 's', '', '', 'فُنْدُقٌ', NULL, NULL, 'فَنَادِقُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.428+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (324, 'Finsko', 'Finland', 's', '', '', 'فِنْلَنْدَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.458+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (325, 'před (časově)', 'before', 'prep', '', '', 'قَبْلَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.478+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (326, 'přijetí', 'reception', 's', 'X', '', 'اِسْتِقْبَالٌ', NULL, NULL, 'اِسْتِقْبَالَاتٌ', 'qbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.498+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (327, 'číst', 'to read sth.', 'v', 'I', 'ه', 'قَرَأَ', NULL, NULL, 'يَقْرَأٌ', 'qrʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.518+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (328, 'hospodářský', 'economic', 'a', 'VIII', '', 'اِقْتِصَادِيٌ', NULL, NULL, '', 'qṣd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.538+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (329, 'řekla jsem mu', 'I told him', 'phr', '', '', 'قُلْتُ لَهُ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.588+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (330, 'ty jsi řekl', 'you said', 'phr', '', '', 'قُلْتَ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.608+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (331, 'ty jsi řekla', 'you said f', 'phr', '', '', 'قُلْتِ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.628+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (332, 'on řekl', 'he said', 'phr', '', '', 'قَالَ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.648+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (333, 'ona řekla', 'she said', 'phr', '', '', 'قَالَتْ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.678+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (334, 'napsat', 'to write sth.', 'v', 'I', '', 'كَتَبَ', NULL, NULL, 'يَكْتُبُ', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.699+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (335, 'já jsem byla', 'I was', 'phr', '', '', 'كُنْتُ', NULL, NULL, '', 'kwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.739+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (336, 'ty jsi byl', 'you were', 'phr', '', '', 'كُنْتَ', NULL, NULL, '', 'kwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.769+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (337, 'ty jsi byla', 'you were', 'phr', '', '', 'كُنْتِ', NULL, NULL, '', 'kwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.789+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (338, 'on byl', 'he was', 'phr', '', '', 'كَانَ', NULL, NULL, '', 'kwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.809+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (339, 'ona byla', 'she was', 'phr', '', '', 'كَانَتْ', NULL, NULL, '', 'kwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.829+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (340, 'Libanon', 'Lebanon', 's', '', '', 'لُبْنَانُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.869+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (341, 'lahodný', 'tasty', 'adv', '', '', 'لَذِيذٌ', NULL, NULL, '', 'lḏḏ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.889+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (342, 'Maďarsko', 'Hungary', 's', '', '', 'المَخَرُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.929+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (343, 'ještě jednou', 'once again', 'phr', '', '', '?مَرَّى أُخْرَى', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.969+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (344, 'nemocný', 'ill, ill person', 'a', '', '', 'مَرِيضٌ', NULL, NULL, 'مَرْضَى', 'mrḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:21.989+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (345, 'víno', 'wine', 's', '', '', 'نَبِيذٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.009+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (346, 'Norsko', 'Norway', 's', '', '', 'النُّرْوِيجُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.049+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (347, 'Rakousko', 'Austria', 's', '', '', 'النِّمْسَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.079+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (348, 'Holandsko', 'Holland', 's', '', '', 'هُوْلَنْدَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.099+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (349, 'přijet', 'to arrive (at,in)', 'v', 'I', 'إِلَى', 'وَصَلَ', NULL, NULL, 'يَسِلُ', 'wṣl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.119+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (350, 'položit, dát', 'to put sth.', 'v', 'I', 'ه', 'وَضَعَ', NULL, NULL, 'يَضَعُ', 'wḍʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.139+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (351, 'vlast', 'home country', 's', '', '', 'وَطَنٌ', NULL, NULL, 'أَوْطَانٌ', 'wṭn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.169+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (352, 'delegace', 'delegation', 's', '', '', 'وَفْدٌ', NULL, NULL, 'وُفُودٌ', 'wfd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.209+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (353, 'profesor', 'professor', 's', '', '', 'أُسْتَاذٌ', NULL, NULL, 'أَسَاتِذَةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.229+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (354, 'tisíc', 'thousand', 'n', '', '', 'أَلْفٌ', NULL, NULL, 'آﻻَفٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.249+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (355, 'America', 'Amerika', 's', '', '', 'أَمْرِيكَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.279+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (356, 'první', 'first', 'm.n', '', '', 'أَوَّل', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.299+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (357, 'první f', 'first f', 'n', '', '', 'أُوْلَى', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.319+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (358, 'který m', 'which m', 'IP', '', '', 'أَيٌّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.359+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (359, 'která f', 'which f', 'IP', '', '', 'أَيَّةٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.39+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (360, 'Za kolik..?', 'How much is...?', 'phr', '', '', 'بِكَمِ؟', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.41+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (361, 'vyřiď pozdravy', 'give so. so. regards', 'phr', 'II', '', 'بَلِّغ', NULL, NULL, '', 'blġ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.43+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (362, 'druhý m', 'second m', 'n', '', '', 'ثَانٍ', NULL, NULL, '', 'ṯny', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.45+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (363, 'druhá f', 'second f', 'n', '', '', 'ثَانِيَةٌ', NULL, NULL, '', 'ṯny', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.49+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (364, 'ten druhý m', 'the second m', 'n', '', '', 'ألثَانِي', NULL, NULL, '', 'ṯny', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.51+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (365, 'ta druhá f', 'the second f', 'n', '', '', 'ألثَانِيَة', NULL, NULL, '', 'ṯny', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.53+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (366, 'cizí, cizinec', 'foreigner,foreign', 's', '', '', 'أجانِبُ', NULL, NULL, 'أَجْنَبِي', 'ğnb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.55+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (367, 'odpověď', 'answer,reply', 's', '', '', 'خَوَاب', NULL, NULL, 'أَخْوِبَة', 'ğwb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.58+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (368, 'účastnit se', 'to attend sth.', 'v', 'I', '', 'حَضَرَ', NULL, NULL, 'يَحْضُرُ', 'ḥḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.60+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (369, 'vy', 'you', 'pron', '', '', 'حَضْرَة', NULL, NULL, 'حَضْرَتُكَ حَضْرَتُكُم', 'ḥḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.63+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (370, 'přednášející', 'lecturer,reader,profesor', 'adv', '', '', 'مُحَاضِر', NULL, NULL, 'مُحَاضِرُونَ', 'ḥḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.65+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (371, 'oslava', 'celebration,party', 's', '', '', 'حَفْلَة', NULL, NULL, 'حَفْﻻَتٌ', 'ḥfl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.68+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (372, 'vláda', 'government', 's', '', '', 'حُكُومَةٌ', NULL, NULL, 'حُكُومَاتٌ', 'ḥkm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.70+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (373, 'pozdravy', 'greeting', 's', '', '', 'تَحِيَّةٌ', NULL, NULL, 'تَحِيَّاتٌ', 'tḥy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.72+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (374, 'zdravím Vás a poté...', 'Best greetings...', 'phr', '', '', 'تَحِيَّةٌ طَيِّبَةٌ وَبَعَدَ', NULL, NULL, '', 'tḥy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.76+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (375, 'služba', 'service', 's', '', '', 'خِدْمَةٌ', NULL, NULL, 'خِدمَاتٌ', 'ḫdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.79+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (376, 'Mohu Vám pomoci?', 'May I help you?', 'phr', '', '', 'أَيَّةٌ خِدْمَة؟', NULL, NULL, '
', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.81+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (377, 'upřímný', 'sincere', 'a', '', '', 'خَالِص ,مُخْلِص', NULL, NULL, '', 'ḫlṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.83+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (378, 'diplomacie,diplomat', 'diplomatic,diplomat', 's', '', '', 'دِبْلُومَاسِيٌّ', NULL, NULL, 'دِبْلُومَاسِيُونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.85+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (379, 'třída,stupeň,úroveň', 'class,step,level', 's', '', '', 'دَرَجَةٌ', NULL, NULL, 'دَرَجَاتٌ', 'drğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.89+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (380, 'učitel', 'teacher,lecturer', 's', 'II', '', 'مُدَرِّسٌ', NULL, NULL, 'مُدَرِّسُونَ', 'drs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.93+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (381, 'dolar', 'dollar', 's', '', '', 'دُوﻻَر', NULL, NULL, 'دُوﻻَرَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.95+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (382, 'lístek', 'ticket,card', 's', '', '', 'تَذْكِرَةٌ', NULL, NULL, 'تَذَاكِرُ', 'ḏkr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:22.97+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (383, 'president', 'president', 's', '', '', 'رَئِيسٌ', NULL, NULL, 'رُؤَساءُ', 'rʾs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (384, 'průvodce,ochranka', 'manager,escort', 's', 'III', '', 'مُرَافِقٌ', NULL, NULL, 'مُرَافِقُونَ', 'rfq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.02+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (385, 'symbol,znak', 'symbol,sign', 's', '', '', 'رَمْزٌ', NULL, NULL, 'رُمُوز', 'rmz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.05+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (386, 'chci', 'I want', 'phr', 'IV', '', 'أُرِيدُ', NULL, NULL, 'يُرِيدُ', 'ʾrd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.07+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (387, 'nádherný', 'wonderful', 'a', '', '', 'رَائِعَ', NULL, NULL, '', 'rjʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.101+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (388, 'týden', 'week', 's', '', '', 'أُسْبُوعٌ', NULL, NULL, 'أَسَابِيعُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.121+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (389, 'divadlo', 'theatre', 's', '', '', 'مَسْرَحٌ', NULL, NULL, 'مَسَارِحُ', 'srḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.141+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (390, 'divadelní hra', 'stage play', 's', '', '', 'مَسْرَحِيَةٌ', NULL, NULL, 'مَسْرَحِياتٌ', 'srḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.161+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (391, 'cena', 'price', 's', '', '', 'سِعْرٌ', NULL, NULL, 'أَسْعارٌ', 'sʾr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.201+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (392, 'cesta', 'journey,trip', 's', '', '', 'سَفَرٌ', NULL, NULL, 'أَسْفَارٌ', 'sfr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.221+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (393, 'cestovatel', 'traveler', 's', '', '', 'مُسَافِرٌ', NULL, NULL, 'مُسَافِرُونَ', 'sfr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.241+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (394, 'turistický', 'touristic', 'a', '', '', 'سِيَاحِيّ', NULL, NULL, '', 'syḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.261+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (395, 'úroveň', 'niveau,level', 's', '', '', 'مُسْتَوًى', NULL, NULL, 'مُسْتَوَات', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.291+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (396, 'děkovat', 'to thank so', 'v', 'I', 'عَلَى', 'شَكَرَ', NULL, NULL, 'يَشْكَرُ', 'škr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.331+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (397, 'sledovat', 'to see,to look at', 'v', 'I', 'ه', 'يَشْحَدُ', NULL, NULL, 'شَاحَدَ', 'šhd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.351+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (398, 'obtížné', 'difficult', 'adv', '', '', 'صَعْبٌ', NULL, NULL, 'صِعَابٌ', 'sʿb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.381+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (399, 'poledne', 'midday,noon', 's', '', '', 'ٌظُهْر', NULL, NULL, '', 'ẓhr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.411+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (400, 'drahý', 'dear', 'adv', '', '', 'عَزِيزٌ', NULL, NULL, 'أَعِزَّاءُ', 'ʿzz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.431+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (401, 'můj drahý m', 'my dear m', 'phr', '', '', 'عَزِيزِي', NULL, NULL, '', 'ʿzz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.451+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (402, 'moje drahá m', 'my dear f', 'a', '', '', 'عَزِيزَتِي', NULL, NULL, '', 'ʿzz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.491+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (403, 'člen', 'member', 's', '', '', 'عُضْوٌ', NULL, NULL, 'أَعْضَاء', 'ʿḍw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.521+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (404, 'svět', 'world', 's', '', '', 'عَالَمٌ', NULL, NULL, 'عَوَالِمُ', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.541+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (405, 'světový', 'international', 'adv', '', '', 'عَالَمِيّ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.561+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (406, 'hluboký', 'deep', 'a', '', '', 'عَمِيق', NULL, NULL, '', 'ʿmq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.591+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (407, 'adresa', 'address', 's', '', '', 'عُنْوَانٌ', NULL, NULL, 'عَنَاوِينُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.621+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (408, 'fyzika', 'physics', 's', '', '', 'فِيزِياء', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.661+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (409, 'silný', 'strong,powerful', 'adv', '', '', 'قَوِيٌّ', NULL, NULL, 'أَقْوِياءُ', 'qwy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.681+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (410, 'kancelář', 'office,desk', 's', '', '', 'مَكْتَبٌ', NULL, NULL, 'مَكَاتِبُ', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.721+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (411, 'cestovní kancelář', 'travel agency', 's', '', '', 'مَكتَبُ السَفَرِ', NULL, NULL, '', 'ktb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.741+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (412, 'chemie', 'chemistry', 's', '', '', 'كِيمِيَاء', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.771+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (413, 'u', 'at', 'prep', '', '', 'لَدَى', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.812+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (414, 'jazyk', 'language', 's', '', '', 'لُغَةٌ', NULL, NULL, 'لُغَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.832+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (415, 'zábavný', 'enjoyable', 'a', '', '', 'مُمْتِعَ', NULL, NULL, '', 'mtʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.852+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (416, 'předmět', 'subject', 's', '', '', 'مَادَّة', NULL, NULL, 'مَوَادُّ', 'mdd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.882+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (417, 'včera večer', ' yesterday evening', 'adv', '', '', 'مَسَاءَ اﻷمسِ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.912+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (418, 'král', 'king', 's', '', '', 'مَلِكٌ', NULL, NULL, 'مُلُوكٌ', 'mlk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.932+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (419, 'očekávání', 'waiting for', 's', '', '', 'اِنْتِظَارٌ', NULL, NULL, '', 'nẓr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.962+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (420, 'takto', 'like this', 'adv', '', '', 'هَكَذَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:23.982+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (421, 'úředník', 'officer', 's', '', '', 'مُوَظَّفٌ', NULL, NULL, 'مُوَظَّفُنَ', 'wẓf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.012+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (422, 'období', 'time,perior of time', 's', '', '', 'وَقْتٌ', NULL, NULL, 'أَوْقَاتٌ', 'wqt', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.032+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (423, 'vzít něco', 'to take sth.', 'v', 'I', 'ه', 'أَخَذَ', NULL, NULL, 'يَأْخُذُ', 'ʾḫḏ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.052+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (424, 'a tak dále, atd.', 'and so on, etc.', 'Phr', '', '', 'إِلَىٰ أَخِرَهِ', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.072+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (425, 'určitě, jistě, definitivně', 'certainly, surely, definitely', 'a', '', '', 'بِالتَّأْكِيدَ', NULL, NULL, '', 'ʾkd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.112+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (426, 'jíst něco', 'eat sth.', 'v', 'I', 'ه', 'أكَلَ', NULL, NULL, 'يَأْكُلُ', 'ʾkl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.132+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (427, 'jídlo, pokrm', 'food, dish, meal', 's', '', '', '', NULL, NULL, 'مَأَكُوﻻَتٌ', 'ʾkl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.152+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (428, 'Evropa, evropský', 's, adv', '', '', '', 'أَوْرُوبَيٌّ?', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.172+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (429, 'Zmrzlina, Ice Cream', 's', '', '', '', 'أَيْسْ كْرِيم', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.192+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (430, 'lilek', 'aubergine, eggplant', 's', '', '', 'بَادِنْجَانَاتٌ', NULL, NULL, 'بَادِنْجَانٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.232+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (431, 'pomeranč', 'orange', 's', '', '', 'بُرتُقَاﻻَتٌ', NULL, NULL, 'بُرتُقَالَةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.262+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (432, 'cibule', 'onion', 's', '', '', 'بَصَلَةٌ', NULL, NULL, 'بَصَلَةٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.292+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (433, 'meloun', 'watermellon', 's', '', '', 'بَطِّيخَةٌ', NULL, NULL, 'بَطِّيخٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.322+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (434, 'brambory', 'potatoes?kontrola', 's', '', '', 'بَطَاطِسُ', NULL, NULL, 'بَطَاطِسُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.352+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (435, 'dobytek', 'cattle', 's', '', '', 'بَقَرٌ', NULL, NULL, 'بَقَرٌ', 'bqr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.372+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (436, 'zelinář', 'green grocer', 's', '', '', '?بَقَّالٌ', NULL, NULL, 'بَقَّالُونَ', 'bql', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.412+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (437, 'bolkón', 'balkony', 's', '', '', 'بَلْكُونٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.442+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (438, 'pivo', 'beer', 's', '', '', 'بِيرٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.483+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (439, 'bílý', 'white m', 's', '', '', 'أبْيَضُ', NULL, NULL, '', 'byḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.533+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (440, 'bílá', 'white f', 's', '', '', 'بَيْضَاءُ', NULL, NULL, '', 'byḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.573+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (441, 'mezi nimi', 'among them', 'phr', '', '', 'بَيْنَهُم', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.603+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (442, 'jablko', 'apple', 's', '', '', 'تُفَاحَةٌ', NULL, NULL, 'تُفَاحٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.643+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (443, 'následující', 'following', 'adj', '', '', 'تَالٍ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.673+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (444, 'poté', 'after that', 'a', '', '', 'ثُمَّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.693+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (445, 'česnek', 'garlic', 's', '', '', 'ثَوْمٌ', NULL, NULL, 'ثَوْمٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.723+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (446, 'číšník', 'waiter', 's', '', '', 'جَرْسُون', NULL, NULL, 'ات', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.753+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (447, 'číšnice', 'waitress', 's', '', '', 'جَرْسُونَة', NULL, NULL, 'ات', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.783+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (448, 'sedět', 'to sit', 'v', 'I', 'عَلىٰ', 'جَلَسَ', NULL, NULL, 'يَجلِسُ', 'ğls', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.823+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (449, 'ořech', 'nut', 's', '', '', 'جَوْزَةٌ', NULL, NULL, 'جَوْزٌ', 'ğwz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.853+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (450, 'hladový', 'hungry m', 'adj', '', '', 'جَوْعَانُ', NULL, NULL, 'جَياحٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.873+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (451, 'hladová', 'hungry f', 'adj', '', '', 'جَوْعَى', NULL, NULL, 'جَياحٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.903+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (452, 'poutník', 'pilgrim', 's', '', '', 'حَاجٌّ', NULL, NULL, 'حُجَّاجٌ', 'hğğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.933+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (453, 'horké, ostré (jídlo)', 'hot, spicy (food)', 's', '', '', 'حَارٌّ', NULL, NULL, '', 'ḥrr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.963+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (454, 'desert, sladkost', 'dessert, sweets', 's', '', '', 'حَلْوَى', NULL, NULL, '', 'ḥlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:24.993+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (455, 'červený', 'red m', 'Adv', '', '', 'أَحْمَرُ', NULL, NULL, '', 'ḥmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.023+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (456, 'červená', 'red f', 'Adv', '', '', 'حَمْرَى', NULL, NULL, '', 'ḥmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.053+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (457, 'život', 'life', 's', '', '', 'حَيَاتٌ', NULL, NULL, '', 'ḥyy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.083+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (458, 'někdy', 'sometimes', 'a', '', '', 'أَحْيَانًا', NULL, NULL, 'ḥyn', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.103+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (459, 'skopové', 'mutton, lamb', 's', '', '', 'خَرُوفٌ', NULL, NULL, 'خِرْفَانٌ', 'ḫrf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.153+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (460, '(zvláště) pro', '(especially) for', 'phr', '', '', 'خَاصَ بِ', NULL, NULL, '', 'ḫwṣ?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.174+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (461, 'zelený', 'green m', 'adj', '', '', 'أَخْضَرُ', NULL, NULL, '', 'ḫḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.204+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (462, 'zelená', 'green f', 'adj', '', '', 'خَضرَاءُ', NULL, NULL, '', 'ḫḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.234+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (463, 'hrozen (vína)', 'vinegar', 's', '', '', 'خَلٌّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.264+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (464, 'jiný', 'different', 'adv', '', '', 'مُخْتَلِفٌ', NULL, NULL, '', 'ḫlf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.284+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (465, 'švestka', 'plum, peach', 's', '', '', 'خَوخٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.324+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (466, 'okurka', 'cucumber', 's', '', '', 'خِيارٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.354+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (467, 'drůbeží', 'chicken', 's', '', '', 'دَجَاجٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.384+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (468, 'vstoupit (do)', 'to enter sth.', 'v', 'I', 'ه', 'دَخَلَ', NULL, NULL, 'يَدْخُلُ', 'dḫl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.404+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (469, 'studovat, učit se', 'to study sth.', 'v', 'I', 'ه', 'دَرَسَ', NULL, NULL, 'يَدْرُسُ', 'drs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.434+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (470, 'mouka', 'flour', 's', '', '', 'دَقِيقٌ', NULL, NULL, '', 'dqq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.464+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (471, 'bez, pod', 'without, under', 'prep', '', '', 'بِدُونِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.504+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (472, 'tato', 'that(f.)', 'pron', '', '', 'تِلْكَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.534+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (473, 'tito', 'those', 'pron', '', '', 'أَوْلَئِكَ', NULL, NULL, '', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.564+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (474, 'vrátit se (do)', 'to come back (to)', 'v', 'I', 'إِلَىٰ', 'رَجَعَ', NULL, NULL, 'يَجْرِعُ', 'rğʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.584+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (475, 'vyhledávání', 'looking up, consulting review', 's', '', '', 'مُرْجَعَةٌ', NULL, NULL, '', 'rğʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.614+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (476, 'rýže', 'rice', 's', '', '', 'رُزٌّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.654+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (477, 'lahev, flaška', 'bottle', 's', '', '', 'زُجَاجَةٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.684+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (478, 'pěstovat něco', 'to plant sth.', 'v', 'I', 'ه', 'زَرَعَ', NULL, NULL, 'يَزْرَعُ', 'zrʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.704+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (479, 'oliva', 'olive', 's', '', '', 'زَيتُونٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.734+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (480, 'otázka', 'question', 's', '', '', 'سُؤَالٌ', NULL, NULL, 'أَسْئِلَةٌ', 'sʾl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.764+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (481, 'žít (v)', 'to live (in)', 'v', 'I', 'فِي', 'سَكَنَ', NULL, NULL, 'يَسْكُنُ', 'skn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.794+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (482, 'nůž', 'knife', 's', '', '', 'سِكِّينُ', NULL, NULL, 'سَكَاكِينُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.834+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (483, 'salát', 'salad', 's', '', '', 'سَلطَةُ', NULL, NULL, '', 'slṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.865+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (484, 'ryba', 'fish', 's', '', '', 'سَمَكٌ', NULL, NULL, 'أسْمَاكٌ', 'smk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.885+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (485, 'rok', 'year', 's', '', '', 'سِنَّةٌ', NULL, NULL, 'سَنَوَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.945+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (486, 'černý', 'black m', 'adj', '', '', 'أَسْوَدُ', NULL, NULL, '', 'swd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:25.985+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (487, 'černá', 'black f', 'adj', '', '', 'سَوْدَاءُ', NULL, NULL, '', 'swd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.015+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (488, 'rozhovor, handrkování', 'haggling about', 's', '', 'عَلىٰ', 'مُسَاوَمَةٌ', NULL, NULL, 'مُسَاوَمَاتٌ', 'swm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.055+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (489, 'polévka', 'soup', 's', '', '', 'شُورْبَةٌ', NULL, NULL, '', 'šrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.085+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (490, 'nákup', 'purchase', 's', '', '', 'شِرَاءُ', NULL, NULL, '', 'šry', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.105+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (491, 'byt, apartmán', 'suite, apartment', 's', '', '', 'شِقَّةٌ', NULL, NULL, 'شِقَق', 'šqq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.135+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (492, 'způsob, cesta, zvyk', 'form, way, manner', 's', '', '', 'شَكْلٌ', NULL, NULL, 'أَشْكَالٌ', 'škl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.165+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (493, 'následovně, následujícím způsobem', 'in the following way', 'phr', '', '', 'بَالشَّكلِ ٱلتَّالِي', NULL, NULL, '', 'škl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.195+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (494, 'vidlička', 'fork', 's', '', '', 'شَوْكَةٌ', NULL, NULL, 'شَوْكَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.225+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (495, 'výraz, vyjádření, termín', 'expression, term', 's', '', '', 'مُصْطَلِحٌ', NULL, NULL, 'مُصْطَلِحَاتٌ', 'ṣlḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.255+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (496, 'důležité (pro)', 'necessary (for)', 'adv', '', '', 'ضَرُورِي لِ', NULL, NULL, '', 'ḍrr?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.285+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (497, 'počasí', 'weather', 's', '', '', 'طَقَسٌ', NULL, NULL, '', 'ṭqs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.315+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (498, 'objednat si, žádat si něco', 'to order sth.', 'v', 'I', 'أَنْ,ه', 'طَلَبَ', NULL, NULL, 'يَطْلُبُ', 'ṭlb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.345+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (499, 'vyžádat si něco z něčeho', 'to as for sth., to demand', 'phr', '', '', 'طَلَبَ مِنْهُ أَنْ', NULL, NULL, '', 'ṭlb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.385+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (500, 'rajče', 'tomato', 's', '', '', 'طَمَاطِمٌ', NULL, NULL, 'طَمَاطَمٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.415+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (501, 'čočka', 'lentils', 's', '', '', 'عَدَسٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.445+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (502, 'minerální', 'mineral', 'adj', '', '', 'مَعَدِنَيٌّ', NULL, NULL, '', 'ʿdn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.475+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (503, 'irácký', 'Iraqi', 'Adv', '', '', 'عِرَاقِيٌّ', NULL, NULL, '', 'ʿrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.505+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (504, 'žíznivý', 'thirsty m', 'adj', '', '', 'عَطْشَانُ', NULL, NULL, 'عِطَاشٌ', 'ʿṭš', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.525+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (505, 'žíznivá', 'thirsty f', 'adj', '', '', 'عَطْشَىٰ', NULL, NULL, 'عِطَاشٌ', 'ʿṭš', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.576+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (506, 'vědět', 'to know sth.', 'v', 'I', 'أَنْ,ه', 'عَلِمَ', NULL, NULL, 'يَعَلِمُ', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.606+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (507, 'pracovat', 'to work', 'v', 'I', 'عَمِلَ', 'يَعمَلُ', NULL, NULL, '', 'ʿml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.636+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (508, 'grapefruit', 'grape', 's', '', '', 'عِنَبٌ', NULL, NULL, 'عِنَبٌ', 'ʿnb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.666+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (509, 'normální, bežné', 'normal', 'adj', '', '', 'عَادِيٌّ', NULL, NULL, '', 'ʿwd?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.696+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (510, 'otevřené', 'open, opened', 'adj', '', '', 'مَفتُوحٌ', NULL, NULL, '', 'ftḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.716+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (511, 'houba, žampión', 'mushroom', 's', '', '', 'فُطْرٌ', NULL, NULL, '', 'fṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.756+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (512, 'prosím m, tu máte', 'please m', 'phr', '', '', 'تَفَضَّلْ', NULL, NULL, '', 'fḍl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.796+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (513, 'prosím f, tu máte', 'please f', 'phr', '', '', 'تَفَضَّلِي', NULL, NULL, '', 'fḍl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.826+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (514, 'prosím (žádáme-li o něco (muže))', 'please (as a request (m.))', 'phr', '', '', 'مِن فَضْلِكَ', NULL, NULL, '', 'fḍl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.856+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (515, 'prosím (žádáme-li o něco (ženu))', 'please (as a request (f.))', 'phr', '', '', 'مِن فَضْلِكِ', NULL, NULL, '', 'fḍl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.886+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (516, 'pepř', 'pepper', 's', '', '', 'فِلْفِلٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.926+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (517, 'pohár, šálek', 'cup', 's', '', '', 'فِنْجَانٌ', NULL, NULL, 'فَنَاجِينُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.966+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (518, 'rozumět', 'to understand sth.', 'v', 'I', 'ه', 'فَهِمَ', NULL, NULL, 'يَفْهَمُ', 'fhm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:26.996+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (519, 'fazole', 'beans', 's', '', '', 'فُوِلٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.026+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (520, 'předkrmy', 'hors d''ouvre', 's', '', '', '', NULL, NULL, 'مُقَابِلَاتُ', 'qbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.046+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (521, 'blízko, v sousedství', 'close to, nearby', 'Phr', '', '', 'قَرِيبَ مِن', NULL, NULL, '', 'qrb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.086+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (522, 'kavárna', 'café', 's', '', '', 'مَقهًى', NULL, NULL, 'مَقَاهٍ', 'qhw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.116+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (523, 'hala, sál', 'hall', 's', '', '', 'قَاعَةٌ', NULL, NULL, 'قَاعَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.146+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (524, 'seznam, index', 'list, index', 's', '', '', 'قَائِمَةٌ', NULL, NULL, 'قَوَائِمُ', 'qwm?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.176+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (525, 'jídelní lístek', 'menu', 's', '', '', 'قَائِمَةُ ٱلطَّعَامِ', NULL, NULL, '', 'qwm?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.206+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (526, 'také, tak jako', 'as, like, futhermore', 'p', '', '', 'كَمَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.226+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (527, 'pohár, sklednice', 'glass', 's', '', '', 'كَأَسٌ', NULL, NULL, 'كُؤُوسٌ', 'kʾs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.257+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (528, 'alkohol', 'alcohol', 's', '', '', 'كُحُولٌ', NULL, NULL, '', 'kḥl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.297+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (529, 'také', 'too, also', 'a', '', '', 'كَذٰلِكَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.327+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (530, 'maso', 'meat', 's', '', '', 'لَحْمٌ', NULL, NULL, 'لُحُومٌ', 'lḥm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.347+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (531, 'důležité pro', 'neccessary for', 'phr', '', '', 'ﻻَزِمٌ لِ', NULL, NULL, '', 'lzm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.377+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (532, 'příjemný, přátelský', 'friendly, nice', 'adj', '', '', 'لَطِيفٌ', NULL, NULL, 'لُطَفَاءُ', 'lṭf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.407+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (533, 'lžíce', 'spoon', 's', '', '', 'مِلْعَقَةٌ', NULL, NULL, 'مَﻻَعِقُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.437+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (534, 'mandle', 'almonds', 's', '', '', 'لَوْزٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.477+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (535, 'barva', 'colour', 's', '', '', 'لَوْنٌ', NULL, NULL, 'أَلوَانٌ', 'lwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.507+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (536, 've dne v noci, 24 hodin denně', 'day and night', 'Phr', '', '', 'لَيْلُ نَهَارِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.527+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (537, 'citrón', 'lemon', 's', '', '', 'لَيْمُونٌ', NULL, NULL, 'لَيْمُونٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.557+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (538, 'časový úsek, doba', 'period of time', 's', '', '', 'مُدَّةٌ', NULL, NULL, 'مُدُد', 'mdd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.587+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (539, 'čas', 'time', 's', '', '', 'مَرَّة', NULL, NULL, '', 'mrr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.627+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (540, 'broskev', 'apricots', 's', '', '', 'مِشْمِشْ', NULL, NULL, 'مِشْمِشْ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.657+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (541, 'sůl', 'salt', 's', '', '', 'مِلْحٌ', NULL, NULL, '', 'mlḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.697+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (542, 'zakázaný', 'forbidden, prohibited', 'Adv', '', '', 'مَمْنُوعٌ', NULL, NULL, '', 'mnʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.717+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (543, 'banán', 'banana', 's', '', '', 'مَوْزٌ', NULL, NULL, 'مَوْزٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.747+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (544, 'voda', 'water', 's', '', '', 'مَاءٌ', NULL, NULL, 'مِيَاءٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.777+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (545, 'co se týče...', 'as far as... is concerned', 'Phr', '', '', 'بِ ٱلنِّسبَةِ لِ', NULL, NULL, '', 'nsb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.817+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (546, 'dívat se, hledět, pozorovat', 'to look at', 'v', 'I', 'إِلَىٰ', 'نَظَرَ', NULL, NULL, 'يَنْظُرُ', 'nẓr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.847+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (547, 'lidé', 'the people', 's', '', '', '', NULL, NULL, 'ألنَّاسٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.877+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (548, 'tito', 'these', 'pron', '', '', 'هٰؤﻻَءِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.927+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (549, 'Ať vám chutná', 'Hope you will enjoy it (the food)', 'phr', '', '', 'هَنِئًا مَرِئًا', NULL, NULL, '', 'hnʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:27.978+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (550, 'Ať vám chutná (odpověď)', 'Hope you will enjoy it (the food) (answer)', 'phr', '', '', 'هَنْأَكَ ٱلْلّٰه', NULL, NULL, 'hnʾ', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.008+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (551, 'chod, jídlo (na jíd. lístku)', 'meal, dish', 's', '', '', 'وَجْبَةٌ', NULL, NULL, 'وَجَبَاتٌ', 'wğb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.038+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (552, 'literatura, písemnictví', 'literature', 's', '', '', 'أَدَبٌ', NULL, NULL, 'آدَابٌ', 'ʾdb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.068+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (553, 'originální, původní, originál', 'original', 's', '', '', 'أَصْلِيٌّ', NULL, NULL, '', 'ʾṣl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.098+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (554, 'rámec', 'frame', 's', '', '', 'إِطَارٌ', NULL, NULL, 'أُطُر', 'ʾṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.128+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (555, 'mnohokrát děkuji', 'Thanks a lot', 'phr', '', '', 'أَلْف شُكرِ', NULL, NULL, '', 'škr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.148+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (556, 'koneference', 'conference', 's', '', '', 'مُؤُتَمَر', NULL, NULL, 'مُؤُتَمَرات', 'ʾmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.178+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (557, 'doufat', 'to hope that', 'v', 'I', 'أَنْ', 'أَمَلَ', NULL, NULL, 'يَأَمُلُ', 'ʾml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.218+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (558, 'sekretariát', 'secretary', 's', '', '', 'أَمِينٌ', NULL, NULL, 'أُمنَاءُ', 'ʾmn
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.248+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (559, 'Generální Sekretariát', 'General Secretary', 's', '', '', 'أَمِينٌ عَامٌّ', NULL, NULL, 'أُمنَاءُ عَامُّونٌ', 'ʾmn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.268+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (560, 'Dá-li Bůh, Doufejme', 'God willing, I hope so, Let us hope', 'Phr', '', '', 'إِن شَاءَ ٱللّٰه', NULL, NULL, '', 'ʾlh', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.308+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (561, 'kvalifikace', 'qualification', 's', '', '', 'تَأْهِيل', NULL, NULL, '', 'ʾhl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.328+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (562, 'diskutovat', 'discuss', 'v', 'I', 'ه', 'بَحَثَ', NULL, NULL, 'يَبْحَثُ', 'bḥṯ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.368+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (563, 'výměna', 'exchange', 's', 'VI', '', 'تَبَادُل', NULL, NULL, 'ات', 'bdl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.408+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (564, 'činit pokroky', 'to make efforts', 'v', 'I', '', 'بَذَلَ', NULL, NULL, 'يَبْذُلُ', 'bḏl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.438+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (565, 'snadné, jednoduché', 'simple, easy', 'adj', '', '', 'بَسِيطٌ', NULL, NULL, 'بُسْطَاءُ', 'bsṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.458+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (566, 'pozítří', 'the day after tomorrow', 'adv', '', '', 'بَعَد غَدٍّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.488+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (567, 'prodavačka, obchodní cestující', ' saleslady', 's', '', '', 'بَائِعَةٌ', NULL, NULL, 'ات', 'bʿʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.518+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (568, 'kulturní', 'cultural', 's', '', '', 'ثَقَافِيٌّ', NULL, NULL, '', 'ṯqf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.558+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (569, 'noviny', 'newspaper', 's', '', '', 'جَرِيدَةٌ', NULL, NULL, 'جَرَائِدُ', 'ğrd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.598+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (570, 'Alžír (město)', 'Algiers', 's', '', '', 'مَدِينَةُ ٱلْجَزَائِرُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.628+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (571, 'Královská výsost', 'His royal highness', 'phr', '', '', 'جَﻼةُ ٱلْمَلِكِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.649+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (572, 'úspěch, pokrok', 'effort', 's', '', '', 'جُهْدٌ', NULL, NULL, 'جُهُودٌ', 'ğhd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.679+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (573, 'cena, ocenění, vyznamenání', 'award, prize', 's', '', '', 'جَائِزَةٌ', NULL, NULL, 'جَوَائِزُ', 'ğʾz?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.709+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (574, 'Nobelova cena', 'Nobel prize', 's', '', '', ' جَوَائِزُ نُوبِل', NULL, NULL, '', 'ğʾz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.749+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (575, 'cesta, tour, výlet, turné', 'tour', 's', '', '', 'جَوْلَةٌ', NULL, NULL, 'ات', 'ğwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.779+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (576, 'pole, oblast, okruh, sektor, areál, lokalita', 'field, area, sphere, sector', 's', '', '', 'مَجَالٌ', NULL, NULL, ' مَجَاﻻَت', 'mğl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.819+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (577, 'aby', 'so that, in order to', 'conj', '', '', 'حَتّٰى', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.839+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (578, 'rozhovory, hovory, vyjednávání, jednání', 's', '', '', '', 'مُحَادَثَاتٌ', NULL, NULL, 'ḥdṯ', '
', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.869+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (579, 'strana, politická strana', 'side, political party', 's', '', '', 'حِزْبٌ', NULL, NULL, 'أَحْزَابٌ', 'ḥzb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.919+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (580, 'dostat, získat', 'to get, to obtain sth.', 'v', 'I', 'علٰى', 'حَصَلَ', NULL, NULL, 'يَحْصُلُ', 'ḥṣl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.959+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (581, 'správní oblast, správní celek, správní obvod', 'governorate, county', 's', '', '', 'مُحَفَظَةٌ', NULL, NULL, 'مُحَفَظَات', 'ḥfẓ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:28.979+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (582, 'ceremoniál, slavnost', 'ceremony', 's', '', '', 'اِحْتِفَالٌ', NULL, NULL, 'اِحْتِفَاَﻻت', 'ḥfl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.019+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (583, 'právo, správnost, pravost', 'law, right', 's', '', '', 'حَقٌّ', NULL, NULL, 'حُقُوقُن', 'ḥqq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.039+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (584, 'Máte pravdu', 'You are right', 's', '', '', 'أنْتَ عَلٰى حَقِّ', NULL, NULL, '', 'ḥqq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.079+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (585, 'Chartům', 'Khartoum', 's', '', '', 'ألْخَرْطُومُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.119+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (586, 'obrana', 'defense', 's', '', '', 'دِفَاعٌ', NULL, NULL, '', 'dfʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.149+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (587, 'demokratický', 'democratic', 'adj', '', '', 'دِيمُوكْرَاطِيٌّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.169+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (588, 'pod vedením', 'under the leadership of', 'phr', '', '', 'بِرِئَاسِةِ', NULL, NULL, '', 'rʾs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.199+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (589, 'synonymum', 'synonym', 's', '', '', 'مُتْرَادِفٌ', NULL, NULL, 'ات', 'rdf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.229+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (590, 'prorok, posel, zvěstovatel', 'prophet, envoy, messenger', 's', '', '', 'رَسُولٌ', NULL, NULL, 'رُسُل', 'rsl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.269+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (591, 'Posel Boží', 'the messenger of God', 'phr', '', '', 'رَسُولُ ٱلْلّٰه', NULL, NULL, '', 'rsl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.309+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (592, 'přát si', 'to wish', 'v', 'I', 'أَنْ, فِي', 'رَغِبَ', NULL, NULL, 'يَرْغَبُ', 'rġb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.34+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (593, 'pobřeží, útes, šelf', 'shelf', 's', '', '', 'رَفٌّ', NULL, NULL, 'رُفُوفٌ', 'rff', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.36+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (594, 'Rus, ruský', 'Russian', 'adj', '', '', 'رُوسِيٌّ', NULL, NULL, 'رُوُسٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.39+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (595, 'farma', 'farm', 's', '', '', 'مَزْرَعَةٌ', NULL, NULL, 'مَزَارِعُ', 'zrʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.42+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (596, 'návštěva', 'visit', 's', '', '', 'زِيَارَةٌ', NULL, NULL, 'ات', 'zyr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.46+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (597, 'roh', 'corner', 's', '', '', 'زَاوِيَةٌ', NULL, NULL, 'زَوَايَا', 'zwy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.52+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (598, 'zodpovědný', 'responsible for', 's', '', 'لِ, عَن', 'مَسْؤُولٌ', NULL, NULL, 'مَسْؤُولُونَ', 'sʾl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.58+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (599, 'dříve, předtím, minule, v minulosti', 'early, in the past, previously', 'a', '', '', 'سَابِقًا', NULL, NULL, '', 'sbq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.62+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (600, 'cesta', 'way, path', 's', '', '', 'سَبِيلٌ', NULL, NULL, 'سُبُلٌ', 'sbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.65+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (601, 'umožnit (někomu něco)', 'to allow (so. to do sth.)', 'v', 'I', 'له بِ ,ه', 'سَمِحَ', NULL, NULL, 'يَسْمَحُ', 'smḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.67+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (602, 'vysvětlit', 'to explain sth.', 'v', 'I', 'ه', 'شَرَحَ', NULL, NULL, 'يَشْرَحُ', 'šrḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.70+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (603, 'projekt', 'project', 's', '', '', 'مَشْرُوعٌ', NULL, NULL, 'مَشَارِعٌ', 'šrḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.73+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (604, 'Je nám ctí, Těší nás', 'Do us the honor', 'phr', '', '', 'شَرِّفْنَا', NULL, NULL, '', 'šrf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.76+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (605, 'Blízký Východ', 'the Middle East', 's', '', '', 'أَلشُّرْقُ ٱﻷَوْسَةُ', NULL, NULL, '', 'šrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.78+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (606, 'společné, spojené, sdílené', 'common, joint, mutual', 's', '', '', 'مُشْتَرَكٌ', NULL, NULL, '', 'šrk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.81+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (607, 'socialista, Socialistický', 'socalist, Socialist', 's', '', '', 'اِشْتِرَاكِيٌّ', NULL, NULL, 'اِشْتِرَاكِيُّونَ', 'šrk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.85+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (608, 'slavný', 'famous', 'Adv', '', '', 'مَشْهُورٌ', NULL, NULL, 'مَشَاهِرُ', 'šhr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.88+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (609, 'kancléř', 'chancellor', 's', '', '', 'مُسْتَشَارٌ', NULL, NULL, 'مُسْتَشَارُونَ', 'ʿšr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.93+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (610, 'továrna', 'factory, plant', 's', '', '', 'مَصْنَعٌ', NULL, NULL, 'مَصَانِعُ', 'ṣnʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.96+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (611, 'přirozeně', 'naturally', 'a', '', '', 'طَبْعًا', NULL, NULL, '', 'ṭbʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:29.99+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (612, 'Tripolis', 'Tripoli', 's', '', '', 'طَرَابُلُسُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.02+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (613, 'slovník, lexikon', 'dictionary, vocabulary, lexicon', 's', '', '', 'مُعَجَمٌ', NULL, NULL, 'مَعَاجِمُ', 'ʿğm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.051+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (614, 'voják, vojenský, armádní', 'soldier, military', 's', '', '', 'عَسْكَرِْيٌّ', NULL, NULL, 'عَسَاكِرُ', 'ʿskr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.071+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (615, 'vzdělání', 'education', 's', 'II', '', 'تَعَلِيمٌ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.101+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (616, 'vyšší vzdělání', 'higher education', 's', 'II', '', 'تَعَلِيمُ ٱلْعَالِي', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.131+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (617, 'laboratoř', 'plant, laboratory', 's', '', '', 'مَعَمِلٌ', NULL, NULL, 'مَعَامِلُ', 'ʿml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.161+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (618, 'pracující, pracovník, zaměstnanec', 'worker, employee', 's', '', '', 'عَامِلٌ', NULL, NULL, 'عُمَّالٌ', 'ʿml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.181+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (619, 'Amán', 'Amman', 's', '', '', 'عَمَّانُ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.211+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (620, 'spolupráce, kooperace', 'cooperation', 's', '', '', 'تَعَاوُن', NULL, NULL, '', 'ʿwn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.241+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (621, 'prázdniny', 'holiday', 's', '', '', 'عِيدٌ', NULL, NULL, 'أَعْيَادٌ', 'ʿjd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.271+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (622, 'potkat', 'to meet so.', 'v', 'III', 'ه', 'قَابَلَ', NULL, NULL, 'يُقَابِلُ', 'qbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.291+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (623, 'pocházející z', 'coming form', 's', '', 'مِن', 'قَادِمًا', NULL, NULL, '', 'qdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.321+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (624, 'oddělení', 'department', 's', '', '', 'قِسْمٌ', NULL, NULL, 'أَقْسَامٌ', 'qsm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.351+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (625, 'ekonomie', 'economy', 's', '', '', 'اِقتِصَادٌ', NULL, NULL, '', 'qṣd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.381+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (626, 'cenný', 'valuable', 'adv', '', '', 'قَيِّمٌ?', NULL, NULL, '', 'qjm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.401+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (627, 'řeč, hovor', 'speech', 's', '', '', 'كَلِمَةٌ', NULL, NULL, 'كَلِمَات', 'klm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.431+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (628, 'aby', 'in order to', 'conj', '', '', 'كَيْ, لِكَيْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.461+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (629, 'moment, chvíle, cvhilka, okamžik', 'moment', 's', '', '', 'لَحْظَةٌ', NULL, NULL, 'لَحْظَاتٌ', 'lḥẓ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.491+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (630, 'nebýt', 'not to be', 'phr', '', '', 'لَيْسَ', NULL, NULL, '', 'lys', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.531+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (631, 'Křesťan, křesťanský', 'Christian', 's', '', '', 'مَسِيحِيٌّ', NULL, NULL, 'مَسِحِيُّونَ', 'msḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.561+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (632, 'pravděpodobnost', 'posibility', 's', '', '', 'إِمْكَانِيَةٌ', NULL, NULL, '', 'mkn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.591+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (633, 'před (časově)', 'since', 'conj', '', '', 'مُنْذٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.611+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (634, 'příležitost', 'occasion, opportunity', 's', '', '', 'مُنَاسَبَةٌ', NULL, NULL, 'ات', 'nsb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.641+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (635, 'při příležitosti', 'in the occasion of', 'phr', '', '', 'بِمُنَاسَبَةِ', NULL, NULL, '', 'nsb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.671+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (636, 'poradit, doporučit', 'to advise', 'v', 'I', 'ه, بِ', 'نَصَحَ', NULL, NULL, 'يَنْصَحُ', 'nṣḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.701+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (637, 'partner, protějšek', 'counterpart', 's', '', '', 'نَظِيرٌ', NULL, NULL, 'نُظْرَاءُ', 'nẓr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.732+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (638, 'diskuse', 'discussion', 's', '', '', 'مُنَاقَشَةٌ', NULL, NULL, 'ات', 'nqš', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.762+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (639, 'zaměřit se na něco, zamířit', 'to aim', 'v', 'I', 'إلى', 'هَدَفَ', NULL, NULL, 'يَهْدُفُ', 'hdf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.782+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (640, 'inženýr', 'engineer', 's', '', '', 'مُهَنْدِسٌ', NULL, NULL, 'مُهَنْدِسُونَ', 'hnds', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.812+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (641, 'přítomný, dostupný', ' existing, available', 'adv', '', '', 'مَوْجُودٌ', NULL, NULL, '', 'wğd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.842+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (642, 'ministr, vezír', 'minister', 's', '', '', 'وَزِيرٌ', NULL, NULL, 'وُزْرَاءُ', 'wzr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.872+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (643, 'ministerstvo', 'ministry', 's', '', '', 'وِزَارَةٌ', NULL, NULL, 'ات', 'wzr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.892+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (644, 'rozšíření, zvětšení, rozměr', 'widening, extension, enlargement', 's', '', '', 'تَوْسِعٌ', NULL, NULL, '', 'wsʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.942+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (645, 'široký', 'wide', 'adj', '', '', 'وَاسِعٌ', NULL, NULL, '', 'wsʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:30.982+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (646, 'jasný, zřetelný, čistý', 'clear, obvious', 'adj', '', '', 'وَاضِحٌ', NULL, NULL, '', 'wḍḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.002+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (647, 'národní', 'national', 'adj', '', '', 'وَطَنِيٌّ', NULL, NULL, '', 'wṭn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.032+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (648, 'podpis', 'signing, signature', 's', '', '', 'تَوْقِعٌ', NULL, NULL, '', 'wqʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.062+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (649, 'tisková agentura, tisková kancelář', 'news agency', 's', '', '', 'وَكَالَةُ أَنْبَاءِ', NULL, NULL, 'ات', 'wkl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.092+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (650, 'tázací částice', 'interrogative particle', 'IP', '', '', 'أَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.112+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (651, 'že ano?, není liž pravda?', 'isn´t it?', 'phr', '', '', 'أَ لَيْسَ كَذَٰلِكَ', NULL, NULL, '', 'lys', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.142+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (652, 'starožitonosti', 'antiquities', 's', '', '', 'آثَرٌ ج', NULL, NULL, '', 'ʾṯr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.172+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (653, 'etonologický, antropologický', 'ethnologic, anthropological', 'adv', '', '', 'إِثْنُولُوجِيٌّ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.202+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (654, 'historie, datum', 'history, date', 's', '', '', 'تَأرِيخٌ', NULL, NULL, '', 'ʾrḫ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.222+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (655, 'španělský', 'Spanish, Spaniard', 'adv', '', '', 'إِسْبَانِيٌّ', NULL, NULL, ' إِسْبَابِيُّونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.252+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (656, 'asijský', 'Asian', 'adv', '', '', 'آسْيُويٌّ', NULL, NULL, 'آسْيُويُّونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.282+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (657, 'africký', 'African', 'adv', '', '', 'إِفْرِيقِيٌّ', NULL, NULL, 'إِفْرِيقِيُّونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.312+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (658, 'co se týče, pokud jde o', 'as far as (?) is concerned...', 'phr', '', '', 'أَمَّا ف...هُوَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.342+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (659, 'forma, dotazník', 'form, questionnaire', 's', 'X', '', 'اِستِئْمَارَةٌ', NULL, NULL, 'اِسْتِئْمَارَاتٌ', 'ʾmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.372+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (660, 'anglický', 'English', 'adv', '', '', 'اِنْكْلِيزِيٌ', NULL, NULL, 'اِنْكْلِيزٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.392+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (661, 'studený', 'cold', 'adv', '', '', 'بَرْدٌ', NULL, NULL, 'بَارَدٌ', 'brd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.422+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (662, 'spropitné, bakšiš', 'tip', 's', '', '', 'بَقْشِيشٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.453+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (663, 'nosič, dveřník', 'porter, doorman', 's', '', '', 'بَوَّابٌ', NULL, NULL, 'بَوَّابُونَ', 'bwb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.483+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (664, 'náležet k', 'to belong to so.', 'v', 'I', 'لِ', 'تَبَعَ', NULL, NULL, 'يَتْبَعُ', 'tbʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.503+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (665, 'náležející k', 'belonging to', 'phr', '', '', 'تَبَيعٌ لِ', NULL, NULL, '', 'tbʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.533+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (666, 'třicátý', 'thirty', 'n', '', '', 'ثَﻻثُونَ', NULL, NULL, '', 'ṯlṯ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.563+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (667, 'sníh, led', 'snow, ice', 's', '', '', 'ثَلْجٌ', NULL, NULL, 'ثُلُوجٌ', 'ṯlğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.593+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (668, 'hory', 'mountain', 's', '', '', 'جَبَلَ', NULL, NULL, 'جِبَالٌ', 'ğbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.613+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (669, 'shromáždit něco', 'to collect sth.', 'v', 'I', 'ه', 'جَمَعَ', NULL, NULL, 'يَجْمَعُ', 'ğmʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.643+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (670, 'strana', 'side', 's', '', '', 'جَانِبٌ', NULL, NULL, 'جَوَانِبُ', 'ğnb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.683+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (671, 'vedle', 'beside', 'phr', '', '', 'اِلىَ جَانِبٍ', NULL, NULL, '', 'ğnb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.713+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (672, 'pas', 'passport?', 's', '', '', 'جَوَاز السَّفَرِ', NULL, NULL, '', 'ğwz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.743+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (673, 'nařídit, objednat', 'to order sth., to book sth.', 'v', '?', 'ه', 'حَجَزَ', NULL, NULL, 'يَحْجُزُ', 'ḥğz', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.773+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (674, 'horko, teplota', 'heat, temperature', 's', '', '', 'حَرَارَةٌ', NULL, NULL, '', 'ḥrr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.803+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (675, 'civilizace, kultura', 'civilization, culture', 's', '', '', 'حَضَارَةٌ', NULL, NULL, 'حَضَارَاتٌ', 'ḥḍr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.823+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (676, 'zavazadlo', 'suitcase', 's', '', '', 'حَقِيبَةٌ', NULL, NULL, 'حَقَائِبُ', 'ḥqb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.853+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (677, 'nést, donést', 'to carry sth.', 'v', 'I', 'ه', 'حَمَلَ', NULL, NULL, 'يَحْمِلُ', 'ḥml', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.883+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (678, 'pomocnice, služebná', 'servant (f.)', 's', '', '', 'خَادِمَةٌ', NULL, NULL, 'خَادِمَاتٌ', 'ḥdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.933+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (679, 'podzim', 'autumn, fall', 's', '', '', '', NULL, NULL, 'حَرِيفٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.963+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (680, 'specializace', 'specialization', 's', 'V', '', 'تَخَصُّصٌ', NULL, NULL, 'تَخَصُّصَاتٌ', 'ḫṣṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:31.993+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (681, 'zvláště, mimořádně', 'especially', 'adv', '', '', ' خَاصَّةً', NULL, NULL, '', 'ḫṣṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.023+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (682, 'nízký', 'low', 'a', 'VII', '', 'مُنْخَفِضٌ', NULL, NULL, '', 'ḫfḍ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.063+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (683, 'stát', 'state', 's', '', '', 'دَوْلَةٌ', NULL, NULL, 'دُوَلٌ', 'dwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.093+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (684, 'náboženství', 'religion', 's', '', '', 'دِيْنٌ', NULL, NULL, 'أَدْيَانٌ', 'dyn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.124+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (685, 'jaro', 'spring', 's', '', '', 'رَبِيعٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.154+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (686, 'vzdělání', 'education', 's', '', '', 'تَرْبِيَةٌ', NULL, NULL, '', 'rby', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.174+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (687, 'informační příručka', 'reference boook', 's', '', '', 'مَرْجَعٌ', NULL, NULL, 'مَرَاجِعُ', 'rğʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.214+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (688, 'levné, přijatelné', 'cheap, reasonable (price)', 's', '', '', 'رَخِيصٌ', NULL, NULL, '', 'rḫṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.254+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (689, 'číslo', 'number', 's', '', '', 'رَقْمٌ', NULL, NULL, 'أَرْقَامٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.274+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (690, 'matematika, výpočty', 'mathematics', 's', '', '', 'الرِّيَاضِيَّاتٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.304+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (691, 'zemědělství', 'agriculture', 's', '', '', 'زِرَاعَةٌ', NULL, NULL, '', 'zrʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.334+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (692, 'manželka', 'wife', 's', '', '', 'زَوْجَةٌ', NULL, NULL, 'زَوْجَاتٌ', 'zwğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.364+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (693, 'spadnout', 'to fall (down)', 'v', 'I', '', 'سَقَطَ', NULL, NULL, 'يَسْقُطُ', 'sqṭ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.404+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (694, 'silný, těžký, objemný', 'thick, heavy', 'a', '', '', '', NULL, NULL, 'سَمِيكٌ', 'smk', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.424+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (695, 'obloha', 'sky', 's', '', '', 'سَمَاءٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.454+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (696, 'zima', 'winter', 's', '', '', 'شِتَاءٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.484+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (697, 'osoba', 'person', 's', '', '', 'شَخَصٌ', NULL, NULL, 'أَشْخَاصٌ', 'šḫṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.514+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (698, 'východní studia', 'oriental studies', 's', 'X', '', 'اِسْتِشْرَاقٌ', NULL, NULL, '', 'šrq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.534+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (699, 'cítit', 'to fell sth.', 'v', 'I', 'بِ', 'شَعَرَ', NULL, NULL, 'يَشْعُرُ', 'šʿr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.574+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (700, 'mrznout', ' to be cold, to freeze', 'phr', '', '', 'شَعَرَ بِالبَرَدِ', NULL, NULL, '', 'šʿr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.604+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (701, 'velice Vám děkuji', 'thank you very much', 'phr', '', '', 'شُكْرًا جَزِيﻻً', NULL, NULL, '', 'škr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.634+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (702, 'sever', 'north', 's', '', '', 'شَمَالٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.664+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (703, 'zdroj, pramen informací', 'source (of information)', 's', '', '', 'مَصْدَرٌ', NULL, NULL, 'مَصَادِرُ', 'ṣdr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.684+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (704, 'léto', 'summer', 's', '', '', 'صَيْفٌ', NULL, NULL, '', 'ṣjf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.724+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (705, 'čínský', 'Chinese', 'a', '', '', 'صِيْبِيٌّ', NULL, NULL, 'صِيْبِيُّونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.754+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (706, 'přidat, zahrnovat, tvořit', 'to comprise', 'v', 'I', 'ه', 'ضَمَّ', NULL, NULL, 'يَضُمُّ', 'ḍmm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.784+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (707, 'kromě čeho', 'in addition to', 'phr', '', '', 'إِضَافَةً إِلَى', NULL, NULL, '', 'ʾḍf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.815+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (708, 'podlaha', 'floor', 's', '', '', 'طَابِقٌ', NULL, NULL, 'طَوَابِقٌ', 'ṭbq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.835+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (709, 'disertace', 'dissertation', 's', '', '', 'أُطْرُوحَةٌ', NULL, NULL, 'أُطْرُوحَاتٌ', 'ṭrḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.865+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (710, 'umírněný, ukázněný', 'moderate, temperate', 'a', '', '', 'مُعْتَدِلٌ', NULL, NULL, '', 'ʿdl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.905+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (711, 'dvacet', 'twenty', 'conj', '', '', 'عِشْرُونَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.945+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (712, 'coat', 'kabát, plášť', 's', '', '', 'مِعْطَفٌ', NULL, NULL, 'مِعَاطِفٌ', 'ʿṭr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.975+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (713, 'věda, studia', 'science, studies', 's', '', '', 'عِلْمٌ', NULL, NULL, 'عُلُومٌ', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:32.995+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (714, 'vědecký', 'scientific', 'a', '', '', 'عِلْمِيٌّ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.025+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (715, 'sociologie', 'sociology', 's', '', '', 'عِلْمُ ﻻجتِمَاعِ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.065+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (716, 'biologie', 'biology', 's', '', '', 'عِلْمُ أَحْيَاءٌ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.095+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (717, 'informace', 'information', 's', '', '', 'مَعْلُومَاتٌ', NULL, NULL, '', 'ʿlm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.125+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (718, 'ústav', 'institute', 's', '', '', 'مَعْهَدٌ', NULL, NULL, 'مَعَاهِدُ', 'ʿhd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.145+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (719, 'ordinace', 'a mediacl doctor´s office', 's', '', '', 'عِيَادَةٌ', NULL, NULL, 'عِيَادَاتٌ', 'ʿyd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.175+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (720, 'opustit', 'to leave sth.', 'v', '?', 'ه', 'غَادَرَ', NULL, NULL, 'يُغَادِرُ', 'ġdr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.205+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (721, 'drahý', 'expensive', 'a', '', '', 'غَالٍ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.245+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (722, 'odvětví, větev', 'branch', 's', '', '', 'فَرْعٌ', NULL, NULL, 'فُرُوعٌ', 'frʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.275+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (723, 'francouzský', 'French', 'a', '', '', 'فِرَنْسِيٌّ', NULL, NULL, 'فِرَنْسِيُّونَ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.295+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (724, 'oddíl, úsek', 'section, paragraph, season', 's', '', '', 'فَصْلٌ', NULL, NULL, 'فُصُولٌ', 'fṣl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.325+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (725, 'rolník, zemědělec', 'peasant, farmer', 's', '', '', 'فَﻻحٌ', NULL, NULL, 'فَﻻحُونَ', 'flḥ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.355+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (726, 'klobouk, čepice', 'hat, cap', 's', '', '', 'فُبَّعَةٌ', NULL, NULL, 'فُبَّعَاتٌ', '?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.385+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (727, 'nadcházející, blížící se', 'coming', 's', '', '', 'قَادِمٌ', NULL, NULL, '', 'qdm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.425+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (728, 'vesnice', 'village', 's', '', '', 'قَرْيَةٌ', NULL, NULL, 'قُرىً', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.445+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (729, 'rukavice', 'glove', 's', '', '', 'قُفَّازٌ', NULL, NULL, 'قَفَافِيزٌ', '?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.475+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (730, 'kolik', ' how much/many', 'pron', '', '', 'كَمْ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.505+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (731, 'za kolik', 'for how much/many', 'phr', '', '', 'بِكَمِ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.536+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (732, 'klimatizace', 'air condition', 's', '', '', 'مُكَيَّفٌ هَوَاءٍ', NULL, NULL, 'ات', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.566+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (733, 'oblékat', 'to dress sth.', 'v', '?', 'ه', 'لَبِسَ', NULL, NULL, 'يَلْبَسُ', 'lbs', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.596+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (734, 'marka', 'German mark', 's', '', '', 'مَاررَكٌ', NULL, NULL, 'مَرَكَاتٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.626+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (735, 'zůstat', 'to stay', 'v', '?', '', 'مَكَثَ', NULL, NULL, 'يَمْكُثُ', 'mkṯ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.656+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (736, 'minibar', 'minibar', 's', '', '', 'مِينِيبَارٌ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.686+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (737, 'indický', 'Indian', 'a', '', '', 'هِنْدِيٌ', NULL, NULL, 'هُنُودٌ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.706+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (738, 'muset', 'to have to, must', 'v', '?', 'أَنْ', 'وَجَبَ', NULL, NULL, 'يَجِبُ', 'wğb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.746+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (739, 'narodil jsem se', 'I was born', 'phr', '', '', 'وُلِدتُّ', NULL, NULL, '', 'wld', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.776+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (740, 'narozeniny, narození', 'birth(day)', 's', '', '', 'مِيﻻدٌ', NULL, NULL, '', 'wld', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.806+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (741, 'denně', 'daily', 'adv', '', '', 'يَوْمِيًا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.836+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (742, 'poslední,minulý', 'last', 'adv', '', '', 'أَخِير', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.856+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (743, 'nakonec', 'eventually,finally', 'a', '', '', 'أَخِيرًا', NULL, NULL, '', 'ʾḫr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.886+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (744, 'proto,tudíž,potom', 'so,therefore,then', 'conj', '', '', 'إِذَن', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.936+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (745, 'základ', 'basic,foundation', 's', '', '', 'أَسَاس', NULL, NULL, 'أُسُس', 'ʾss', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.966+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (746, 'v podstatě', 'basically', 'a', '', '', 'أَسَاسيّ', NULL, NULL, '', 'ʾss', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:33.996+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (747, 'Sunnité', 'Sunnites', 's', '', '', 'أَهْل السُنَّة', NULL, NULL, '', 'snn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.026+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (748, 'začínat', 'to begin,to start', 'v', 'I', '', 'بَدَأَ', NULL, NULL, 'يَبْدَأُ', 'bdʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.056+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (749, 'začátek', 'beginning', 's', '', '', 'بِدَأيَة', NULL, NULL, '', 'bdʾ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.096+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (750, 'dělat,rovnat se', 'to amount to', 'v', 'I', 'ه', 'بَلِغ', NULL, NULL, 'يَبْلُغُ', 'blġ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.126+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (751, 'syn', 'son', 's', '', '', 'اِبْن', NULL, NULL, 'أبْنَاء،بَنُون', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.156+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (752, 'zemřel', 'died', 'v', '', '', 'تُوُفِّيَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.186+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (753, 'mít úspěch,následovat', 'to come after,to succeed', 'v', 'I', 'ه', 'تَبِع', NULL, NULL, 'يَتْبَعُ', 'tbʿ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.217+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (754, 'pouť', 'pilgrimage', 's', '', '', 'حَجٌّ', NULL, NULL, 'حَجَّاتٌ،حِجَجٌ', 'ḥğğ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.247+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (755, 'souhlas', 'according to', 's', '', '', 'حَسَبٌ', NULL, NULL, '', 'ḥsb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.277+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (756, 'účet', 'calculation,bill', 's', '', '', 'حِسَابٌ', NULL, NULL, 'حِسَابَاتٌ', 'ḥsb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.307+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (757, 'současný', 'present,current', 'adv', '', '', 'حَالِي', NULL, NULL, '', 'ḥwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.337+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (758, 'skoro,téměř', 'nearly,approximately', 'a', '', '', 'حَوَالَىْ', NULL, NULL, '', 'ḥwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.377+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (759, 'být úspěšný', 'to succeed to so', 'v', 'I', 'ه', 'خَلَفَ', NULL, NULL, 'يَخْلُفُ', 'ğlf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.407+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (760, 'chalífa', 'caliph', 's', '', '', 'خَلِيفَةٌ', NULL, NULL, 'خُلَفَاءُ', 'ḫlf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.437+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (761, 'správně vedení chalífové', 'the Rightly Guided Caliphs', 'phr', '', '', 'الخُلَفَاء الرَاشِدُون', NULL, NULL, '', 'ḫlf', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.467+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (762, 'administrativa', 'administration', 's', '', '', 'إِدَارَةٌ', NULL, NULL, 'إِدَرَاتٌ', 'dwr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.497+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (763, 'dinár', 'dinar', 's', '', '', 'دِينَارٌ', NULL, NULL, 'دَنَانِيرُ', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.537+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (764, 'právní škola', 'school of law', 's', '', '', 'مَذْهَبٌ', NULL, NULL, 'مَذَاهِبُ', 'ḏhb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.597+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (765, 'Prosím za prominutí', ' I beg yuor pardon', 'phr', '', '', 'أَرْجُو اﻻِعْتِذَار', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.627+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (766, 'Ať je s ním Bůh spokojený', 'May God be pleased with him', 'phr?', '', '', 'رِضَيَ ٱلْلّٰه عَنَه', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.657+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (767, 'pilíř', 'pillar', 's', '', '', 'رُكْنٌ', NULL, NULL, 'أَرْكَانٌ', 'rkn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.697+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (768, 'on chce', 'he wants', 'phr', 'IV', '', 'يُرِيدُ أَنْ', NULL, NULL, '', 'ʾrd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.727+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (769, 'zakát', 'zakát', 's', '', '', 'زَكَاةٌ', NULL, NULL, '', 'zkw?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.757+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (770, 'zakát na konci Ramadánu', 'zakát at the end of Ramadan', 'phr', '', '', 'زَكَاة الفِطْر', NULL, NULL, '', 'zkw?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.777+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (771, 'plus', 'plus', 's', '', '', 'زَائد', NULL, NULL, '', 'zwd?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.807+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (772, 'registrace', 'registration', 's', 'II', '', 'تَسْجِيل', NULL, NULL, 'تَسْجِيﻻَت', 'sğl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.847+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (773, 'schodiště', 'staircase', 's', '', '', 'سُلِّمٌ', NULL, NULL, 'سَﻻَلِمُ', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.877+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (774, 'Mír s ním', 'Peace be upon him', 'phr', '', '', 'عَلِيهِ السَﻻَم', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.908+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (775, 'muslim', 'muslim', 's', '', '', 'مُسْلِم', NULL, NULL, 'مُسْلِمُونَ', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.948+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (776, 'Islám', 'Islam', 's', '', '', 'اِﻹسْﻻَم', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.968+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (777, 'islámský', 'islamic', 'a', '', '', 'إِسْﻻَميّ', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:34.998+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (778, 'Sunna', 'Sunna', 's', '', '', 'السُّنَّة', NULL, NULL, '', 'snn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.038+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (779, 'stejný', 'equals', 'adv', '', '', 'يُسَاوِي', NULL, NULL, '', 'swy?', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.068+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (780, 'svědectví', 'the act of testimony', 's', 'بِ', '', 'الشَهَادَةُ', NULL, NULL, '', 'šhd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.088+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (781, 'upřímný,čestný', 'honest,upright', 'a', '', '', 'الصَّدِّيق', NULL, NULL, '', 'ṣdq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.118+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (782, 'výtah', 'lift', 's', '', '', 'مِصْعَدٌ', NULL, NULL, 'مَصَاعِدُ', 'ṣʿd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.148+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (783, 'Bůh mu požehnej a dej mu spásu', 'God bless him and grant him salvation', 'phr', '', '', 'صَلَّى ٱلْلّٰه عَلِيه وَ سَلِّم', NULL, NULL, '', 'slm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.178+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (784, 'modlitba', 'prayer', 's', '', 'صَﻼَةٌ', 'صَلَوَاتٌ', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.218+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (785, 'ranní modlitba', 'morning prayer', 's', '', '', 'صَﻻَة الفَجْر/الصُبْح', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.238+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (786, 'polední modlitba', 'midday prayer', 's', '', '', 'صَﻻَة الظُهْر', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.268+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (787, 'odpolední modlitba', 'afternoon prayer', 's', '', '', 'صَﻻَة العَصْر', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.298+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (788, 'večerní modlitba', 'evening prayer', 's', '', '', 'صَﻻَة المَغْرِب', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.328+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (789, 'noční modlitba', 'night prayer', 's', '', '', 'صَﻻَة العِشَاءَ', NULL, NULL, '', 'ṣlw', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.358+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (790, 'postit se', 'fasting', 'v', 'I', '', 'صَوْمٌ', NULL, NULL, '', 'ṣwm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.388+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (791, 'se rovná', 'equals', 'phr', 'III', '', 'يُعَادِلُ', NULL, NULL, '', 'ʿdl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.418+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (792, 'spolehnutí na', 'relying on', 's', 'VIII', 'عَلى', 'اِعْتِمَادٌ', NULL, NULL, '', 'ʿmd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.448+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (793, 'budova', 'building', 's', '', '', 'عِمَارَةٌ', NULL, NULL, 'عِمَارَاتٌ', 'ʿmr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.488+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (794, 'rok', 'year', 's', '', '', 'عَامٌ', NULL, NULL, 'أَعْوَام', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.518+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (795, 'většina', 'majority', 's', '', '', 'غَالِبيَّةٌ', NULL, NULL, 'غَالِبيَّاتٌ', 'ġlb', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.558+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (796, 'před', 'before', 'prep', '', '', 'مِن قَبْلُ', NULL, NULL, '', 'qbl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.578+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (797, 'mínění', 'estimation', 's', '', '', 'تَقْدِيرٌ', NULL, NULL, 'تَقْدِيرَاتٌ', 'qdr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.609+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (798, 'rozdělovat', 'divided by', 'v', 'I', 'عَلَى', 'مَقْسُومٌ', NULL, NULL, '', 'qsm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.639+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (799, 'kalendář', 'calendar', 's', 'II', '', 'تَقْوِيمٌ', NULL, NULL, '', 'qwm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.669+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (800, 'zůstat', 'stay', 'v', 'I', '', 'إِقَامَةٌ', NULL, NULL, 'إِقَامَاتٌ', 'qwm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.689+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (801, 'řekla jsem ti', 'I told you', 'phr', '', '', 'قُلْتُ لَكَ ∖ لَكِ', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.729+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (802, 'řekli mi', '´they told me', 'phr', '', '', 'قَالُوا لِي', NULL, NULL, '', 'qwl', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.759+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (803, 'ctihodný', 'venerable', 'a', '', '', 'المُكَرَّمَةٌ', NULL, NULL, '', 'krm', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.789+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (804, 'jazyk,řeč', 'tongue,language', 's', '', '', 'لِسَانٌ', NULL, NULL, 'أَلْسُن،أَلَسِنَةٌ', 'lsn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.809+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (805, 'fakulta jazyků', 'faculty of languages', 's', '', '', 'كُلِّيَّةُ اﻻلَسُن', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.839+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (806, 'proč', 'why', 'pron', '', '', 'لِمَاذَا', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.869+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (807, 'včetně', 'including', 'a', '', '', 'بِمَا فِي ذَلِكَ', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.909+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (808, 'procenta', 'percent', 's', '', '', 'بَالَمَائة', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.949+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (809, 'Medína', 'Medina', 's', '', '', 'المَدِينَة المُنَوَّرَة', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:35.989+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (810, 'Mekka', 'Mecca', 's', '', '', 'مَكَّةُ المُكَرَّمَة', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.019+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (811, 'může', 'he can', 'v', 'I', '', 'يُمْكِنُ ال٠٠٠', NULL, NULL, '', 'mkn', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.049+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (812, 'prorok', 'prophet,messenger', 's', '', '', 'نَبِيّ', NULL, NULL, 'نَبِيُونَ ،أنْبِياءُ', 'nby', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.079+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (813, 'mínus', 'minus', 's', '', '', 'ٌنَاقِص', NULL, NULL, '', 'nqṣ', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.109+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (814, 'konec', 'end', 's', '', '', 'ٌنِهَايَة', NULL, NULL, '', 'nhy', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.139+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (815, 'osvícený', 'shining,enlightened', 'a?', '', '', 'المُنَوَّرَة', NULL, NULL, '', 'nwr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.159+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (816, 'emigrovat', 'to emigrate', 'v', 'III', '', 'هَاجَرَ', NULL, NULL, 'يُهَاجِرُ', 'hğr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.189+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (817, 'Hidžra', 'the Hijra', 's', '', '', 'الهِجْرَةُ', NULL, NULL, '', 'hğr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.229+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (818, 'letopočtu Hidžry', 'of the Hijra', 's', '', '', 'هِجْرَيٌّ', NULL, NULL, '', 'hğr', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.259+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (819, 'strojírenství', 'engineering', 's', '', '', 'هَنْدَسَةٌ', NULL, NULL, '', 'hds', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.289+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (820, 'nález', '(the) findings', 's', '', '', 'إِيْجَادٌ', NULL, NULL, '', 'wğd', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.31+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (821, 'odpovídající', 'corresponding', 'adv', '', '', 'مُوَافِقٌ', NULL, NULL, '', 'wfq', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.34+02', 0, NULL, 0);
INSERT INTO dict ("IDdict", czech, english, word_category, verbal_class, present, past, phrase, impert, valence, root, rezerve, field, source, lection, "language", word_voice, usr, date_created, autorized, author, context) VALUES (822, 'Jaṯrib', 'Yathrib(Medina)', 's', '', '', 'يَثْرِب', NULL, NULL, '', '', NULL, 1, 0, '2', 1, NULL, 0, '2005-05-23 20:30:36.37+02', 0, NULL, 0);


--
-- Data for Name: exam; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1095, 13, 2347, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1092, 13, 2068, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1098, 13, 2091, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1093, 13, 2368, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1100, 13, 2168, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1117, 14, 2305, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1115, 14, 2367, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1102, 14, 2389, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1104, 14, 2082, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1111, 14, 2323, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1109, 14, 2358, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1108, 14, 2295, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1106, 14, 2175, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1099, 13, 2037, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1119, 14, 2037, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1103, 14, 2332, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1120, 14, 2058, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1094, 13, 2283, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1101, 14, 2272, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1105, 14, 2283, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1118, 14, 2233, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1142, 15, 2185, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1141, 15, 2384, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1158, 15, 2350, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1138, 15, 2327, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1124, 15, 2294, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1165, 15, 2205, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1148, 15, 2086, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1160, 15, 2093, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1137, 15, 2064, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1132, 15, 2072, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1145, 15, 2203, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1144, 15, 2141, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1121, 15, 2214, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1146, 15, 2253, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1154, 15, 2401, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1170, 15, 2257, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1153, 15, 2306, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1155, 15, 2258, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1114, 14, 2254, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1166, 15, 2067, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1133, 15, 2074, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1157, 15, 2316, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1167, 15, 2247, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1134, 15, 2207, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1168, 15, 2360, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1135, 15, 2071, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1097, 13, 2301, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1151, 15, 2410, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1127, 15, 2107, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1123, 15, 2301, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1152, 15, 2197, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1128, 15, 2249, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1136, 15, 2299, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1169, 15, 2125, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1122, 15, 2326, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1140, 15, 2375, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1162, 15, 2284, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1139, 15, 2211, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1130, 15, 2193, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1129, 15, 2087, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1164, 15, 2254, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1143, 15, 2348, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1150, 15, 2195, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1161, 15, 2279, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1116, 14, 2169, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1159, 15, 2169, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1147, 15, 2355, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1175, 16, 2084, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1180, 16, 2220, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1177, 16, 2237, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1126, 15, 2296, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1178, 16, 2296, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1179, 16, 2355, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1172, 16, 2190, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1173, 16, 2325, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1199, 18, 2088, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1191, 18, 2150, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1222, 21, 2183, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1227, 21, 2053, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1225, 21, 2154, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1176, 16, 2372, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1223, 21, 2372, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1226, 21, 2188, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1230, 21, 2398, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1224, 21, 2274, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1228, 21, 2391, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1198, 18, 2045, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1221, 21, 2045, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1219, 20, 2280, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1215, 20, 2248, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1214, 20, 2251, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1213, 20, 2315, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1220, 20, 2277, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1218, 20, 2266, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1216, 20, 2166, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1186, 17, 2140, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1211, 20, 2140, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1217, 20, 2352, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1203, 19, 2174, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1202, 19, 2212, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1206, 19, 2376, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1201, 19, 2065, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1204, 19, 2206, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1205, 19, 2404, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1210, 19, 2078, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1207, 19, 2232, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1208, 19, 2395, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1235, 28, 2307, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1091, 13, 2337, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1237, 28, 2117, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1096, 13, 2191, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1149, 15, 2337, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1163, 15, 2039, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1232, 28, 2191, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1234, 28, 2345, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1240, 28, 2337, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1236, 28, 2039, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1231, 28, 2331, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1239, 28, 2048, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1238, 28, 2240, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1233, 28, 2153, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1184, 17, 2123, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1187, 17, 2335, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1171, 16, 2357, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1181, 17, 2222, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1188, 17, 2357, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1189, 17, 2098, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1125, 15, 2105, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1190, 17, 2338, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1183, 17, 2186, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1112, 14, 2210, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1185, 17, 2105, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1182, 17, 2210, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1194, 18, 2314, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1197, 18, 2243, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1131, 15, 2132, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1196, 18, 2066, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1193, 18, 2121, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1200, 18, 2132, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1156, 15, 2167, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1195, 18, 2167, 0);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1241, 29, 2379, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1242, 29, 2032, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1243, 29, 2315, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1244, 29, 2390, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1245, 29, 2148, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1246, 29, 2269, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1247, 29, 2129, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1248, 29, 2192, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1249, 29, 2319, NULL);
INSERT INTO exam ("IDexam", examing, dict, status) VALUES (1250, 29, 2170, NULL);


--
-- Data for Name: examing; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (13, 3, '2005-05-16 19:49:07.064+02', 0, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (14, 3, '2005-05-16 19:56:41.228+02', 0.15000001, 5, 20, 'from_en');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (15, 3, '2005-05-16 20:08:30.007+02', 0, 5, 50, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (16, 3, '2005-05-17 09:26:13.041+02', 0.1, 5, 10, 'from_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (21, 3, '2005-05-19 22:37:40.301+02', 0.1, 5, 10, 'from_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (20, 3, '2005-05-19 18:55:09.059+02', 0.1, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (19, 3, '2005-05-17 11:54:41.223+02', 10, 5, 10, 'from_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (28, 3, '2005-05-20 13:16:11.897+02', 0, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (22, 3, '2005-05-20 13:05:28.622+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (23, 3, '2005-05-20 13:07:21.595+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (24, 3, '2005-05-20 13:13:12.82+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (25, 3, '2005-05-20 13:13:22.924+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (26, 3, '2005-05-20 13:14:19.416+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (27, 3, '2005-05-20 13:15:30.187+02', 100, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (17, 3, '2005-05-17 11:40:34.666+02', 0, 5, 10, 'to_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (18, 3, '2005-05-17 11:40:57.148+02', 10, 5, 10, 'from_cz');
INSERT INTO examing ("IDexaming", "user", date, rating, source, count, "type") VALUES (29, 2, '2005-05-21 17:27:41.584+02', -1, 5, 10, 'from_cz');


--
-- Data for Name: field; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO field ("IDfield", field) VALUES (1, 'default field');
INSERT INTO field ("IDfield", field) VALUES (6, 'pohádky, children story');
INSERT INTO field ("IDfield", field) VALUES (8, 'electronic');
INSERT INTO field ("IDfield", field) VALUES (10, 'hadith');
INSERT INTO field ("IDfield", field) VALUES (11, 'koranic');
INSERT INTO field ("IDfield", field) VALUES (12, 'jurnalistic');
INSERT INTO field ("IDfield", field) VALUES (13, 'medicin');
INSERT INTO field ("IDfield", field) VALUES (15, 'proverb');
INSERT INTO field ("IDfield", field) VALUES (16, 'osmanic');
INSERT INTO field ("IDfield", field) VALUES (17, 'prosa');
INSERT INTO field ("IDfield", field) VALUES (18, 'poetry');
INSERT INTO field ("IDfield", field) VALUES (19, 'popular');
INSERT INTO field ("IDfield", field) VALUES (20, 'talmud');
INSERT INTO field ("IDfield", field) VALUES (21, 'technical science');
INSERT INTO field ("IDfield", field) VALUES (22, 'science fiction');
INSERT INTO field ("IDfield", field) VALUES (23, 'textbook');
INSERT INTO field ("IDfield", field) VALUES (24, 'thora');
INSERT INTO field ("IDfield", field) VALUES (7, 'počícomputer');
INSERT INTO field ("IDfield", field) VALUES (9, 'fable');


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO "language" ("IDlanguage", "language") VALUES (1, 'arabic');
INSERT INTO "language" ("IDlanguage", "language") VALUES (2, 'hebrew');
INSERT INTO "language" ("IDlanguage", "language") VALUES (3, 'akkad');


--
-- Data for Name: source; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO source ("IDsource", title, subtitle, place, publication, publication_no, from_page, to_page, "language", "year") VALUES (5, 'Základy moderní spisovné arabštiny', 'díl I.', 'Praha', '', '', 1, 1, 1, '2003');
INSERT INTO source ("IDsource", title, subtitle, place, publication, publication_no, from_page, to_page, "language", "year") VALUES (6, 'Základy moderní spisovné arabštiny', 'díl II.', 'Praha', '', '', 1, 1, 1, '2003');
INSERT INTO source ("IDsource", title, subtitle, place, publication, publication_no, from_page, to_page, "language", "year") VALUES (7, 'Základy starobabylonoštiny', '', 'Praha', '', '', 1, 1, 1, '2000');
INSERT INTO source ("IDsource", title, subtitle, place, publication, publication_no, from_page, to_page, "language", "year") VALUES (1, 'zdroj v akkadštině', '', '', '', '', 12, 2, 3, '');


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: jara
--

INSERT INTO "user" ("IDuser", name, surname, city, email, nationality, number_of_usage, date_created, date_last_visit, "privileges", nick, pass) VALUES (6, 'Testovaci', 'uzivatel1', '', 'dfghr@fdgd.vf', '', 0, '2005-05-03 09:59:12.47718+02', '2005-05-03 09:59:12.47718+02', 1, 'qwe', 'qwe');
INSERT INTO "user" ("IDuser", name, surname, city, email, nationality, number_of_usage, date_created, date_last_visit, "privileges", nick, pass) VALUES (5, 'Petr', 'Bechyne', '', 'sdfgsd@dfsdf.vf', '', 6, '2005-05-03 09:45:10.405257+02', '2005-05-15 15:07:06+02', 3, 'beda', 'beda');
INSERT INTO "user" ("IDuser", name, surname, city, email, nationality, number_of_usage, date_created, date_last_visit, "privileges", nick, pass) VALUES (3, 'Testovaci', 'uzivatel2 ', '', 'wedwe@dsdx.ds', '', 32, '2005-04-26 07:51:38+02', '2005-05-20 13:03:23+02', 2, 'kiki', 'kiki');
INSERT INTO "user" ("IDuser", name, surname, city, email, nationality, number_of_usage, date_created, date_last_visit, "privileges", nick, pass) VALUES (2, 'Jaroslav', 'Bauml', '', 'sdfgsd@dfsdf.vf', '', 22, '2005-04-19 10:36:18+02', '2005-05-21 17:27:26+02', 3, 'jara', 'asd');


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: plpgsql_call_handler(); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION plpgsql_call_handler() FROM PUBLIC;
REVOKE ALL ON FUNCTION plpgsql_call_handler() FROM postgres;
GRANT ALL ON FUNCTION plpgsql_call_handler() TO postgres;
GRANT ALL ON FUNCTION plpgsql_call_handler() TO PUBLIC;


--
-- Name: plpgsql_validator(oid); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION plpgsql_validator(oid) FROM PUBLIC;
REVOKE ALL ON FUNCTION plpgsql_validator(oid) FROM postgres;
GRANT ALL ON FUNCTION plpgsql_validator(oid) TO postgres;
GRANT ALL ON FUNCTION plpgsql_validator(oid) TO PUBLIC;


--
-- Name: database_size(name); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION database_size(name) FROM PUBLIC;
REVOKE ALL ON FUNCTION database_size(name) FROM postgres;
GRANT ALL ON FUNCTION database_size(name) TO postgres;
GRANT ALL ON FUNCTION database_size(name) TO PUBLIC;


--
-- Name: pg_database_size(oid); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_database_size(oid) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_database_size(oid) FROM postgres;
GRANT ALL ON FUNCTION pg_database_size(oid) TO postgres;
GRANT ALL ON FUNCTION pg_database_size(oid) TO PUBLIC;


--
-- Name: pg_dir_ls(text, boolean); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_dir_ls(text, boolean) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_dir_ls(text, boolean) FROM postgres;
GRANT ALL ON FUNCTION pg_dir_ls(text, boolean) TO postgres;
GRANT ALL ON FUNCTION pg_dir_ls(text, boolean) TO PUBLIC;


--
-- Name: pg_file_length(text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_length(text) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_length(text) FROM postgres;
GRANT ALL ON FUNCTION pg_file_length(text) TO postgres;
GRANT ALL ON FUNCTION pg_file_length(text) TO PUBLIC;


--
-- Name: pg_file_read(text, bigint, bigint); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_read(text, bigint, bigint) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_read(text, bigint, bigint) FROM postgres;
GRANT ALL ON FUNCTION pg_file_read(text, bigint, bigint) TO postgres;
GRANT ALL ON FUNCTION pg_file_read(text, bigint, bigint) TO PUBLIC;


--
-- Name: pg_file_rename(text, text, text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_rename(text, text, text) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_rename(text, text, text) FROM postgres;
GRANT ALL ON FUNCTION pg_file_rename(text, text, text) TO postgres;
GRANT ALL ON FUNCTION pg_file_rename(text, text, text) TO PUBLIC;


--
-- Name: pg_file_rename(text, text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_rename(text, text) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_rename(text, text) FROM postgres;
GRANT ALL ON FUNCTION pg_file_rename(text, text) TO postgres;
GRANT ALL ON FUNCTION pg_file_rename(text, text) TO PUBLIC;


--
-- Name: pg_file_stat(text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_stat(text) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_stat(text) FROM postgres;
GRANT ALL ON FUNCTION pg_file_stat(text) TO postgres;
GRANT ALL ON FUNCTION pg_file_stat(text) TO PUBLIC;


--
-- Name: pg_file_unlink(text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_unlink(text) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_unlink(text) FROM postgres;
GRANT ALL ON FUNCTION pg_file_unlink(text) TO postgres;
GRANT ALL ON FUNCTION pg_file_unlink(text) TO PUBLIC;


--
-- Name: pg_file_write(text, text, boolean); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_file_write(text, text, boolean) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_file_write(text, text, boolean) FROM postgres;
GRANT ALL ON FUNCTION pg_file_write(text, text, boolean) TO postgres;
GRANT ALL ON FUNCTION pg_file_write(text, text, boolean) TO PUBLIC;


--
-- Name: pg_logdir_ls(); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_logdir_ls() FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_logdir_ls() FROM postgres;
GRANT ALL ON FUNCTION pg_logdir_ls() TO postgres;
GRANT ALL ON FUNCTION pg_logdir_ls() TO PUBLIC;


--
-- Name: pg_postmaster_starttime(); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_postmaster_starttime() FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_postmaster_starttime() FROM postgres;
GRANT ALL ON FUNCTION pg_postmaster_starttime() TO postgres;
GRANT ALL ON FUNCTION pg_postmaster_starttime() TO PUBLIC;


--
-- Name: pg_relation_size(oid); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_relation_size(oid) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_relation_size(oid) FROM postgres;
GRANT ALL ON FUNCTION pg_relation_size(oid) TO postgres;
GRANT ALL ON FUNCTION pg_relation_size(oid) TO PUBLIC;


--
-- Name: pg_reload_conf(); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_reload_conf() FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_reload_conf() FROM postgres;
GRANT ALL ON FUNCTION pg_reload_conf() TO postgres;
GRANT ALL ON FUNCTION pg_reload_conf() TO PUBLIC;


--
-- Name: pg_size_pretty(bigint); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_size_pretty(bigint) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_size_pretty(bigint) FROM postgres;
GRANT ALL ON FUNCTION pg_size_pretty(bigint) TO postgres;
GRANT ALL ON FUNCTION pg_size_pretty(bigint) TO PUBLIC;


--
-- Name: pg_tablespace_size(oid); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION pg_tablespace_size(oid) FROM PUBLIC;
REVOKE ALL ON FUNCTION pg_tablespace_size(oid) FROM postgres;
GRANT ALL ON FUNCTION pg_tablespace_size(oid) TO postgres;
GRANT ALL ON FUNCTION pg_tablespace_size(oid) TO PUBLIC;


--
-- Name: relation_size(text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION relation_size(text) FROM PUBLIC;
REVOKE ALL ON FUNCTION relation_size(text) FROM postgres;
GRANT ALL ON FUNCTION relation_size(text) TO postgres;
GRANT ALL ON FUNCTION relation_size(text) TO PUBLIC;


--
-- Name: pg_logdir_ls; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE pg_logdir_ls FROM PUBLIC;
REVOKE ALL ON TABLE pg_logdir_ls FROM postgres;
GRANT ALL ON TABLE pg_logdir_ls TO postgres;
GRANT ALL ON TABLE pg_logdir_ls TO PUBLIC;


--
-- PostgreSQL database dump complete
--

