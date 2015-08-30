# Fermaatti
Dominante-kuoron intranet. Alustana on avoimen lähdekoodin [OwnCloud](https://owncloud.org/).

## Kehitysympäristö

Koska haluamme, että koodaustyö on kivaa ja ongelmatonta, pystytämme kehitysympäristön Vagrant-nimisen systeemin avulla.

Asenna ensiksi [Vagrant](https://www.vagrantup.com/downloads.html) ja [VirtualBox](https://www.virtualbox.org/wiki/Downloads). Windows-käyttäjien kannattaa käyttää tavallisia installereita (löytyy linkkien takaa). Mac -käyttäjät puolestaan voivat tehdä asennuksen parilla [Homebrewin](http://brew.sh/) komennolla:
```
brew install caskroom/cask/brew-cask
brew cask install vagrant virtualbox
```

Seuraavaksi kopioi Fermaatin Git-repository koneellesi. Tähän voit käyttää esimerkiksi [GitHubin omaa sovellusta](https://mac.github.com/). Kun repository on kopioitu, mene komentorivillä repositoryn hakemistoon ja aja siellä seuraava komento:

```
vagrant up
```

Komento pystyttää virtuaalisen palvelimen ([Scotch Box 2.0](https://box.scotch.io/)) kehitystyötä varten. Tässä menee aikaa, ja levytilaa kuluu muutama giga. Kun operaatio on valmis, palvelin on käynnissä, ja menemällä selaimessa osoitteeseen `http://192.168.33.10/` pääset ihastelemaan Fermaattia.

Nyt voit koodata Fermaattia `/public` -kansion sisältöä muokkaamalla. Jos sinun tarvitsee tehdä virtuaalipalvelimella asioita, voit ottaa ssh-yhteyden Ubuntuun seuraavasti, kun olet repositoryn hakemistossa:
```
vagrant ssh
```

Lisäohjeita löytyy [Scotch Boxin saitilta](https://box.scotch.io/).

## Tietokannan populointi

### OwnCloud

Tiedostossa `populate-db.sql`  on kehityksen kannalta mukavat asetukset OwnCloudiin. Tietokanta kannattaa päivittää sql-tiedoston mukaiseksi heti kehitysympäristön pystytyksen jälkeen:

```
cd /var/www
mysql scotchbox < populate-db.sql
```

Tämän jälkeen pääset kirjautumaan OwnCloudiin tunnuksilla `admin`/`admin`.

Jos sql-tiedostoa halutaan päivittää, se onnistuu seuraavalla komennolla:

```
mysqldump scotchbox > populate-db.sql
```

### Kuorolaisten yhteystiedot

Kuorolaisten yhteystiedot ovat salassapidettäviä, ja siksi ne pitää hakea Fermaatin palvelimelta:

```
cd /var/www
scp kayttaja@fermaatti.dominante.fi:/var/db-dumps/choir-members-dump.sql choir-members-dump.sql
mysql scotchbox < choir-members-dump.sql
```

Tiedostonimi `choir-members-dump.sql` on gitignoressa.

## Deploy

Käytämme [Setting up Push-to-Deploy with git](http://krisjordan.com/essays/setting-up-push-to-deploy-with-git) -artikkelin mukaista Git-pohjaista deployta.

Deploy-työnkulku on tiedostossa `deploy/post-receive`. Jos sitä päivitetään, se täytyy käsin päivittää palvelimella olevan repositoryn `.git/hooks/` -hakemistoon.

## OwnCloudin päivittäminen

Fermaatin OwnCloud -asennus kannattaa päivittää säännöllisesti, esimerkiksi puolen vuoden välein. Helpointa on päivittää nykyiseen `8.1.X` -releaseen pelkät tietoturvapäivitykset (tällöin versionumero muuttuu esim. `8.1.0` => `8.1.1`).

Viimeistään 4/2017, kun `8.1.X` -releasea ei tueta, kannattaa tehdä iso versiopäivitys, joka vaatii suuremman työmäärän (appien yhteensopivuus täytyy tuolloin tarkistaa).

Kaikki päivitykset tehdään [manuaalisen päivityksen ohjeita mukaillen](https://doc.owncloud.org/server/8.1/admin_manual/maintenance/upgrade.html#manual-upgrade-procedure). Muista backup tuotannon tietokannasta! OwnCloud-asennuksen tiedostoista ei tarvitse backupia, koska vanhat tiedostot ovat Gitissä tallessa.