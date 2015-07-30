# Fermaatti
Dominante-kuoron intranet

# Kehitysympäristö

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

Komento pystyttää virtuaalisen Ubuntu-palvelimen kehitystyötä varten. Tässä menee aikaa, ja levytilaa kuluu muutama giga. Kun operaatio on valmis, palvelin on käynnissä, ja menemällä selaimessa osoitteeseen `http://192.168.33.10/` pääset ihastelemaan Fermaattia.

Nyt voit koodata Fermaattia `/public` -kansion sisältöä muokkaamalla. Jos sinun tarvitsee tehdä virtuaalipalvelimella asioita, voit ottaa ssh-yhteyden Ubuntuun seuraavasti, kun olet repositoryn hakemistossa:
```
vagrant ssh
```