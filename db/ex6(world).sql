-- Ex 6. --
select countries.name, countries.independence_year, languages.language from countries, languages
where countries.code=languages.country_code and countries.independence_year=1948;

select countries.name from countries, languages
where countries.code=languages.country_code and
((languages.language='French' and languages.official='T') or
(languages.language='English' and languages.official='T'));

select language, count(country_code) from languages, countries
where countries.code=languages.country_code and
countries.life_expectancy > 75
group by language order by count(country_code) desc limit 5;

select capital from countries, languages
where countries.code=languages.country_code and
(languages.language='Korean' and languages.language='English');

select capital from countries, languages
where countries.code=languages.country_code and
(languages.official='T' and languages.percentage>20 and languages.percentage<50);

select sum(surface_area) from countries,
	(select country_code, avg(population) from cities group by country_code
		order by avg(population) desc limit 5) as NEWTABLE
where NEWTABLE.country_code=countries.code;
