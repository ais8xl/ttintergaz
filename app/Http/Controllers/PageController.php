<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function welcome() 
    {
        return view('welcome');
    }

    public function clientList() 
    {
        $clientName = DB::select('SELECT ID, Name FROM clients');
        return view('KlientuSaraksts')->with(compact('clientName'));
    }
    
    public function clientDeliveries($clientID) 
    {
        $clDel = DB::select('SELECT clients.Name, addresses.Title, routes.Date, delivery_lines.QTY, deliveries.Status
        FROM clients
        INNER JOIN addresses ON clients.ID = addresses.ClientID
        INNER JOIN deliveries ON addresses.ID = deliveries.AddressID
        INNER JOIN delivery_lines ON deliveries.ID = delivery_lines.DeliveryID
        INNER JOIN routes ON deliveries.RouteID = routes.ID
        WHERE clients.ID = ?', [$clientID]);

        $statuses = array('nav izpildīts', 'ir izpildīts', 'atcelts');

        return view('KlientuPiegades')->with(compact('clDel', 'statuses'));
    }
    
    public function report1() 
    {
        $multipleDel = DB::select('SELECT clients.Name, addresses.Title
        FROM clients
        INNER JOIN addresses ON clients.ID = addresses.ClientID
        INNER JOIN deliveries ON addresses.ID = deliveries.AddressID
        GROUP BY clients.Name, addresses.Title HAVING COUNT(DISTINCT deliveries.Type) > 1');
        return view('Atskaite1')->with(compact('multipleDel'));
    }
    
    public function report2() 
    {
        $report2 = DB::select('SELECT temp.Name, temp.Title, temp.Date, deliveries.Type, delivery_lines.Price
        FROM (SELECT clients.ID, clients.Name, addresses.ID AS AddressID, addresses.Title, MAX(deliveries.ID) AS dl_id, MAX(routes.Date) AS Date
        FROM clients
        LEFT JOIN addresses ON clients.ID = addresses.ClientID
        LEFT JOIN deliveries ON addresses.ID = deliveries.AddressID
        LEFT JOIN routes ON deliveries.RouteID = routes.ID
        GROUP BY clients.ID, clients.Name, addresses.Title, addresses.ID) AS temp
        LEFT JOIN delivery_lines ON temp.dl_id = delivery_lines.DeliveryID
        LEFT JOIN deliveries ON temp.dl_id = deliveries.ID
        ORDER BY temp.Date DESC');

        $statuses = array('šķidrā prece', 'cietā prece');
        
        return view('Atskaite2')->with(compact('report2', 'statuses'));
    }
    
    public function report3() 
    {
        $report3 = DB::select("SELECT clients.Name, deliveries.Type, addresses.Title 
        FROM (SELECT DISTINCT  addresses.ID FROM addresses 
        LEFT JOIN deliveries ON deliveries.AddressID = addresses.ID 
        GROUP BY addresses.ID HAVING count(DISTINCT deliveries.Type) = 1) AS TEMP
        LEFT JOIN addresses ON addresses.ID = TEMP.ID
        LEFT JOIN deliveries ON deliveries.AddressID = TEMP.ID
        LEFT JOIN clients ON addresses.ClientId = clients.ID
        WHERE deliveries.Type != 1");

        return view('Atskaite3')->with(compact('report3'));
    }

    public function ajaxRequestPost()
    {
        $id = $_POST['id_client'];

        $address = DB::selectOne('SELECT * FROM addresses WHERE ClientID = ?', [$id]);

        return $address->Title;
    }
}