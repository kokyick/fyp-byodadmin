<?php 
namespace App\Http\Controllers;
use App\Library\Api;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Input;
use Excel;

class ExcelController extends Controller
{
public function importExport()
{
	return view('importExport');
}
public function downloadExcel($type)
{
	$data = Item::get()->toArray();
	return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
	$excel->sheet('mySheet', function($sheet) use ($data)
	        {
	$sheet->fromArray($data);
	        });
	})->download($type);
}
	public function importExcel(Request $request)
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				$mid=$request->mid;
				foreach ($data as $key => $value) {
					$myBody['merchant_id'] = $mid;
					$myBody['food_type'] = $value->food_type;
					$myBody['avg_ratings'] = 0;
					$myBody['name'] = $value->name;
					$myBody['price'] = $value->price;
					$myBody['product_image'] = "https://i.imgur.com/LGZIB40.png";
					//dd($myBody);
					

					if(!empty($myBody)){
						//insert to DB (DB::table('items')->insert($insert);)
						$result =Api::postRequest("MerchantProducts/",$myBody);
					}
				}
			}
		}
		return back();
	}
}