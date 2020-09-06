# Frazių generavimas

Ši programa generuoja nuostabos frazes iš ištiktukų, būdvardžių bei daiktavardžių. Patikusius galima išsaugoti į unikalią nuorodą.

## Pasileidimas lokaliai

Symfony karkasui bus reikalingas composer, jog būtų gali įdiegti visus reikalingus įskiepius. (NAUDOTAS symfony/website-skeleton struktūra)

```bash
Reikalingų įskiepių pavadinimai composer.json faile.
```

Programa puikiai veikia per XAMPP įrankį. Visos nuorodos yra pasiekiamos per /public/index.php/[nuorodos] . 

Kad programa galėtų įrašyti norimas nuorodas į duomenų bazę reikia įvykdyti migracija.


```bash
pip bin/console doctrine:migrations:migrate
```

## Naudojimas

Programa yra patalpinta Heroku platformoje -  [nuoroda](https://peaceful-garden-60345.herokuapp.com/)

Atsidarius programa iškart yra sugeneruojama frazė, kurią galima išsaugoti, arba generuoti sekančia. Taip pat yra paieškos laukelis kuriame galima įvesti savo išsaugotos frazės nuorodą. Nuorodos galima išekoti ir tiesiog URL laukelyje įvedus savo nuorodos kodą. 

## Naudoti įrankiai
VS Code, Symfony, XAMPP, Heroku, MySql, PostgresSQL
