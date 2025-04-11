<?php

declare(strict_types=1);

class PIDRegler extends IPSModule
{
    public function Create()
    {
        parent::Create();

        // Eigenschaften für Konfiguration
        $this->RegisterPropertyFloat('P', 1.0);
        $this->RegisterPropertyFloat('I', 0.1);
        $this->RegisterPropertyFloat('D', 0.0);
        $this->RegisterPropertyFloat('AntiWindupLimit', 100.0);
        $this->RegisterPropertyInteger('SampleTime', 1000); // in ms

        // Variablen für Ein-/Ausgang
        $this->RegisterVariableFloat('Input', 'Eingang', '~Temperature', 1);
        $this->RegisterVariableFloat('Output', 'Ausgang', '~Valve', 2);
        $this->RegisterVariableFloat('Setpoint', 'Sollwert', '~Temperature', 3);
        $this->RegisterVariableBoolean('Active', 'Aktiv', '~Switch', 4);
        $this->RegisterVariableBoolean('ManualMode', 'Manueller Modus', '~Switch', 5);
        $this->RegisterVariableFloat('ManualValue', 'Manueller Wert', '~Valve', 6);

        // Variablen für Visualisierung
        $this->RegisterVariableFloat('Error', 'Regelabweichung', '~Temperature', 7);
        $this->RegisterVariableFloat('P_Value', 'P-Anteil', '', 8);
        $this->RegisterVariableFloat('I_Value', 'I-Anteil', '', 9);
        $this->RegisterVariableFloat('D_Value', 'D-Anteil', '', 10);

        // Timer für Regelung
        $this->RegisterTimer('PIDTimer', 0, 'PIDRegler_Update(' . $this->InstanceID . ');');
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();

        // Timer mit konfigurierter Abtastzeit starten
        $this->SetTimerInterval('PIDTimer', $this->ReadPropertyInteger('SampleTime'));
    }

    public function Update()
    {
        if (!$this->ReadPropertyBoolean('Active')) {
            return;
        }

        // Prüfen ob manueller Modus aktiv ist
        if (GetValue($this->GetIDForIdent('ManualMode'))) {
            $manualValue = GetValue($this->GetIDForIdent('ManualValue'));
            SetValue($this->GetIDForIdent('Output'), $manualValue);
            return;
        }

        // Aktuelle Werte lesen
        $input = GetValue($this->GetIDForIdent('Input'));
        $setpoint = GetValue($this->GetIDForIdent('Setpoint'));
        
        // Reglerparameter
        $p = $this->ReadPropertyFloat('P');
        $i = $this->ReadPropertyFloat('I');
        $d = $this->ReadPropertyFloat('D');
        $antiWindupLimit = $this->ReadPropertyFloat('AntiWindupLimit');
        
        // Regelabweichung berechnen
        $error = $setpoint - $input;
        SetValue($this->GetIDForIdent('Error'), $error);
        
        // P-Anteil
        $pValue = $p * $error;
        SetValue($this->GetIDForIdent('P_Value'), $pValue);
        
        // I-Anteil mit Anti-Windup
        static $iValue = 0;
        $iValue += $i * $error * ($this->ReadPropertyInteger('SampleTime') / 1000.0);
        $iValue = max(min($iValue, $antiWindupLimit), -$antiWindupLimit);
        SetValue($this->GetIDForIdent('I_Value'), $iValue);
        
        // D-Anteil (erste Ableitung der Regelabweichung)
        static $lastError = 0;
        $dValue = $d * ($error - $lastError) / ($this->ReadPropertyInteger('SampleTime') / 1000.0);
        $lastError = $error;
        SetValue($this->GetIDForIdent('D_Value'), $dValue);
        
        // Stellgröße berechnen und begrenzen
        $output = $pValue + $iValue + $dValue;
        $output = max(min($output, 100), 0);
        
        // Ausgang setzen
        SetValue($this->GetIDForIdent('Output'), $output);
    }

    /**
     * Setzt einen manuellen Wert für die Stellgröße
     * @param float $value Der gewünschte Stellwert (0-100%)
     */
    public function SetManualValue(float $value)
    {
        // Wert auf gültigen Bereich begrenzen
        $value = max(min($value, 100), 0);
        
        // Manuellen Wert setzen
        SetValue($this->GetIDForIdent('ManualValue'), $value);
        
        // Wenn manueller Modus aktiv ist, wird der Wert sofort übernommen
        if (GetValue($this->GetIDForIdent('ManualMode'))) {
            SetValue($this->GetIDForIdent('Output'), $value);
        }
    }
} 