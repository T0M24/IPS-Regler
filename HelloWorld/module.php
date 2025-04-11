<?php

declare(strict_types=1);

// Klassendefinition
class HelloWorld extends IPSModule
{
    // Der Konstruktor des Moduls
    // Überschreibt den Standard Konstruktor von IPS
    public function __construct($InstanceID)
    {
        // Diese Zeile nicht löschen
        parent::__construct($InstanceID);

        // Selbsterstellter Code
    }

    // Überschreibt die interne IPS_Create($id) Funktion
    public function Create()
    {
        // Diese Zeile nicht löschen.
        parent::Create();

        // Variable für die Hello World Nachricht anlegen
        $this->RegisterVariableString("Message", "Nachricht", "", 0);
        $this->SetValue("Message", "Hello World");
    }

    // Überschreibt die intere IPS_ApplyChanges($id) Funktion
    public function ApplyChanges()
    {
        // Diese Zeile nicht löschen
        parent::ApplyChanges();
    }

    /**
     * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
     * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wie folgt zur Verfügung gestellt:
     *
     * HW_UpdateMessage($id);
     *
     */
    public function UpdateMessage()
    {
        $time = date("H:i:s");
        $this->SetValue("Message", "Hello World! Es ist jetzt " . $time);
    }
} 