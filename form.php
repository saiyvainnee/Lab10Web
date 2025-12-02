<?php
/**
 * Nama Class: Form
 * Deskripsi: Class untuk membuat form inputan text sederhana
 */

class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action = "", $submit = "Submit Form")
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm()
    {
        // gunakan htmlspecialchars pada action
        $actionEsc = htmlspecialchars($this->action);
        echo "<form action='{$actionEsc}' method='POST'>";
        echo '<table width="100%" border="0">';

        for ($j = 0; $j < count($this->fields); $j++) {
            $label = htmlspecialchars($this->fields[$j]['label']);
            $name  = htmlspecialchars($this->fields[$j]['name']);
            echo "<tr><td align='right'>{$label}</td>";
            echo "<td><input type='text' name='{$name}'></td></tr>";
        }

        echo "<tr><td colspan='2'>";
        echo "<input type='submit' value='" . htmlspecialchars($this->submit) . "'>";
        echo "</td></tr>";
        echo "</table>";
        echo "</form>";
    }

    public function addField($name, $label)
    {
        $this->fields[$this->jumField]['name']  = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }
}
?>
