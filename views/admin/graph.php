<?php
// view for graph books in categories

require_once('../../lib/jpgraph/src/jpgraph.php');
require_once('../../lib/jpgraph/src/jpgraph_bar.php');
include_once "../../models/Book_Table.class.php";
include_once "../../models/DB.class.php";
$db = DB::get();
$bookTable = new Book_Table($db);
$booksInCategory = $bookTable->getBooksInCategory();

$response = "";
$databaseResults = [];
while ($result = $booksInCategory->fetchObject()) {
    array_push($databaseResults, $result);
}

foreach ($databaseResults as $row) {
    $category [] = $row->category_description;
    $count [] = $row->count;
}

$graph = new Graph(500, 400, 'auto');

$graph->SetScale("textlin");

class MyTheme extends OceanTheme
{

    private $axis_color = '#0a0a0a';

    function GetColorList()
    {
        return [
            '#0b82ff',
            '#b7ceff',
        ];
    }

    function SetupGraph($graph)
    {
        parent::SetupGraph($graph);
        $graph->xaxis->SetColor($this->axis_color, $this->font_color);
        $graph->yaxis->SetColor($this->axis_color, $this->font_color);
    }
}

$graph->SetTheme(new MyTheme());

$graph->xaxis->SetTickLabels($category);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_BOLD);

$graph->yaxis->title->SetFont(FF_VERDANA, FS_BOLD);

$graph->title->Set('Project Shopping');
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 20);
$bplot1 = new BarPlot($count);

$gbarplot = new GroupBarPlot(array($bplot1));
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);

$bplot1->value->Show();
$bplot1->SetLegend('inkomsten');
$graph->Stroke();
// return view to the browser
//return $response;