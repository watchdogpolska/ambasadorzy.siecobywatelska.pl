# Ambasadorzy Jawności

Repozytorium strony internetowej Ambasadorów Jawności Sieci Obywatelskiej Watchdog Polska

#### Proszę sprawdzić plik `constants.inc` i odpowiednio wypełnić wartości stałych przed uruchomieniem wersji produkcyjnej

## Szczegółowa instrukcja instalacji

Wymagania:
* serwer Apache z obsługą PHP
* dostęp do bazy MySQL
* włączona funkcja `mail()` w `php.ini`

1. Skopiować wszystkie pliki do katalogu `htdocs` serwera;
2. W pliku `functions.inc` i `admin/functions.inc` zakomentować (`//`) dwie linie kodu: 
```
error_reporting(-1); //Comments these two lines to disable error reporting - NEED TO BE DONE IN PRODUCTION PHRASE!
ini_set('display_errors', 'On');
```

3. Uzupełnić plik `constants.inc` o odpowiednie wartości stałych.
4. Wejść na adres serwera/strony.
5. Wypełnić odpowiednimi danymi formularz konfiguracyjny.
6. **Zostanie utworzony domyślny użytkownik o loginie `root` i haśle `123456`**
7. **Jak najszybciej zmienić hasło domyślnego użytkownika** w panelu administracyjnym (po uprzednim zalogowaniu) - panel dostępny jest pod `adres_serwera/admin`.
8. Korzystać z oprogramowania!
