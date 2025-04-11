# IPS PID-Regler Modul

Ein Modul für IP-Symcon V8.0 zur Implementierung eines PID-Reglers mit Anti-Windup-Funktion.

## Funktionen

- PID-Regelung mit einstellbaren Parametern (P, I, D)
- Anti-Windup-Funktion zur Vermeidung der I-Anteil-Übersteuerung
- Einstellbare Grenzen für die Stellgröße (0-100%)
- Aktivierung/Deaktivierung des Reglers
- Visualisierung von Sollwert, Istwert und Stellgröße
- Zentrale Konfigurationsvariablen für einfache Parametrierung

## Installation

1. Modul in IP-Symcon über den Modul-Store installieren
2. Modul in der gewünschten Instanz hinzufügen
3. Konfigurationsvariablen anpassen
4. Ein- und Ausgangsvariablen verknüpfen

## Konfiguration

### Erforderliche Variablen
- Eingangsvariable (Temperatur in °C)
- Ausgangsvariable (Ventilstellwert in %)
- Sollwert
- Aktivierung

### Reglerparameter
- P-Anteil
- I-Anteil
- D-Anteil
- Anti-Windup-Begrenzung
- Abtastzeit

## Support

Bei Fragen oder Problemen wenden Sie sich bitte an den Support.