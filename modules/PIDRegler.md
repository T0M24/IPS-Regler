# PID-Regler Modul

## Beschreibung
Das PID-Regler Modul ermöglicht die Implementierung eines PID-Reglers mit Anti-Windup-Funktion in IP-Symcon. Es ist besonders geeignet für Temperaturregelungen in Heizungsanlagen.

## Funktionen
- PID-Regelung mit einstellbaren Parametern (P, I, D)
- Anti-Windup-Funktion zur Vermeidung der I-Anteil-Übersteuerung
- Einstellbare Grenzen für die Stellgröße (0-100%)
- Aktivierung/Deaktivierung des Reglers
- Manueller Modus für direkte Stellwertvorgabe
- Visualisierung von Sollwert, Istwert und Stellgröße
- Visualisierung der P/I/D-Anteile und Regelabweichung

## Konfiguration

### Reglerparameter
- **P-Anteil**: Proportionalanteil des Reglers (Standard: 1.0)
- **I-Anteil**: Integralanteil des Reglers (Standard: 0.1)
- **D-Anteil**: Differentialanteil des Reglers (Standard: 0.0)
- **Anti-Windup-Begrenzung**: Maximale Begrenzung für den I-Anteil (Standard: 100.0)
- **Abtastzeit**: Aktualisierungsintervall des Reglers in Millisekunden (Standard: 1000ms)

### Variablen
- **Eingang**: Temperatur-Istwert in °C
- **Ausgang**: Ventilstellwert in %
- **Sollwert**: Gewünschte Temperatur in °C
- **Aktiv**: Aktivierung/Deaktivierung des Reglers
- **Manueller Modus**: Umschaltung zwischen automatischem und manuellem Betrieb
- **Manueller Wert**: Stellwert im manuellen Modus (0-100%)
- **Regelabweichung**: Differenz zwischen Soll- und Istwert
- **P/I/D-Anteile**: Aktuelle Werte der Regleranteile

## Verwendung

### Automatischer Modus
1. Reglerparameter anpassen
2. Sollwert setzen
3. Regler aktivieren

### Manueller Modus
1. Manuellen Modus aktivieren
2. Manuellen Wert setzen (0-100%)

### PHP-Funktionen
```php
// Manuellen Stellwert setzen
PIDRegler_SetManualValue($instanceID, 50.0); // Setzt Stellwert auf 50%
```

## Tipps zur Parametrierung
1. Beginnen Sie mit dem P-Anteil
2. Erhöhen Sie den I-Anteil bei zu langsamer Regelung
3. Fügen Sie den D-Anteil hinzu, um Überschwingen zu reduzieren
4. Passen Sie die Anti-Windup-Begrenzung an die maximal erlaubte Stellgröße an

## Fehlerbehebung
- Bei zu starkem Überschwingen: D-Anteil erhöhen oder P-Anteil reduzieren
- Bei zu langsamer Regelung: P-Anteil erhöhen oder I-Anteil anpassen
- Bei Oszillationen: D-Anteil reduzieren oder P-Anteil erhöhen 