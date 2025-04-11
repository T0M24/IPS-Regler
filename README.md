# Hello World

Dieses Modul ist ein einfaches Beispiel für IP-Symcon ab Version 6.0.

## Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)

## 1. Funktionsumfang

* Ausgeben einer einfachen "Hello World"-Nachricht
* Beispiel für die Struktur eines IP-Symcon-Moduls

## 2. Voraussetzungen

- IP-Symcon ab Version 6.0

## 3. Software-Installation

* Über den Module Store das 'Hello World'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen:
  `https://github.com/IHR_BENUTZERNAME/HelloWorld`

## 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'Hello World'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

## 5. Statusvariablen und Profile

Die Statusvariablen werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

### Statusvariablen

Name | Typ | Beschreibung
------------ | ------------- | -------------
Message | String | Enthält die "Hello World"-Nachricht

### Profile

Es werden keine zusätzlichen Profile benötigt.

## 6. WebFront

Die Statusvariablen werden im WebFront angezeigt.

## 7. PHP-Befehlsreferenz

`void HW_UpdateMessage(integer $InstanzID);`
Aktualisiert die "Hello World"-Nachricht.

Beispiel:
`HW_UpdateMessage(12345);` 