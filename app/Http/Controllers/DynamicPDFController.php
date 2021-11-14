<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use PDF;

class DynamicPDFController extends Controller
{
    function index()
    {
        $items = $this->get_item_data();
        return view('dynamic_pdf')->with('items', $items);
    }

    function get_item_data()
    {
        $items = Item::all();
        return $items;
    }

    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->stream();
    }

    function convert_customer_data_to_html()
    {
        $items = $this->get_item_data();
        $output = '
     <h3 align="center">Equipment</h3>
     <table style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;">#</th>
    <th style="border: 1px solid; padding:12px;">Name</th>
    <th style="border: 1px solid; padding:12px;">Model</th>
    <th style="border: 1px solid; padding:12px;">Description Code</th>
    <th style="border: 1px solid; padding:12px;">Website</th>
    <th style="border: 1px solid; padding:12px;">Avail</th>
    <th style="border: 1px solid; padding:12px;">All</th>
   </tr>
     ';
        foreach($items as $item)
        {
            $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$item->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->model.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->description.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->url.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->amount.'</td>
       <td style="border: 1px solid; padding:12px;">'.$item->all_amount.'</td>
      </tr>
      ';
        }
        $output .= '</table>';
        return $output;
    }
}
