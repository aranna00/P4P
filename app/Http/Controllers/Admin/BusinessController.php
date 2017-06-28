<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Address;
    use App\Business;
    use App\Http\Controllers\Controller;
    use Cache;
    use Illuminate\Http\Request;
    use Toastr;

    class BusinessController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $businesses=Business::with(["shipping", "billing", "users"])->paginate(8);
            
            return view("admin.businesses.index", compact(["businesses"]));
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view("admin.businesses.create");
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $shipping=new Address();
            $shipping->postcode=$request->get("postcode")["shipping"];
            $shipping->straat=$request->get("straat")["shipping"];
            $shipping->straat_url=$request->get("straat_url")["shipping"];
            $shipping->huisnummer=$request->get("huisnummer")["shipping"];
            $shipping->huisnummertoevoeging=$request->get("huisnummertoevoeging")["shipping"];
            $shipping->plaats=$request->get("plaats")["shipping"];
            
            $billing=new Address();
            $billing->postcode=$request->get("postcode")["billing"];
            $billing->straat=$request->get("straat")["billing"];
            $billing->straat_url=$request->get("straat_url")["billing"];
            $billing->huisnummer=$request->get("huisnummer")["billing"];
            $billing->huisnummertoevoeging=$request->get("huisnummertoevoeging")["billing"];
            $billing->plaats=$request->get("plaats")["billing"];
            
            $business=new Business();
            $business->handelsnaam=$request->get("handelsnaam");
            $business->handelsnaam_url=$request->get("handelsnaam_url");
            $business->kvk=$request->get("kvk");
            $business->subdossiernummer=$request->get("subdossiernummer");
            $business->bestaandehandelsnaam=$request->get("bestaandehandelsnaam");
            $business->relatie_nummer=$request->get("relatienummer");
            
            $shipping->save();
            $billing->save();
            
            $business->billing()->associate($billing);
            $business->shipping()->associate($shipping);
            $business->save();

            Toastr::success("De klant ". $business->handelsnaam ." is succesvol toegevoegd!");
            
            return response()->redirectToAction("Admin\BusinessController@index");
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\Business $business
         *
         * @return \Illuminate\Http\Response
         */
        public function show(Business $business)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $idø
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $business=Business::find($id);
            
            return view("admin.businesses.edit", compact(["business"]));
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $business=Business::find($id);
            
            $shipping=$business->shipping;
            $shipping->postcode=$request->get("postcode")["shipping"];
            $shipping->straat=$request->get("straat")["shipping"];
            $shipping->straat_url=$request->get("straat_url")["shipping"];
            $shipping->huisnummer=$request->get("huisnummer")["shipping"];
            $shipping->huisnummertoevoeging=$request->get("huisnummertoevoeging")["shipping"];
            $shipping->plaats=$request->get("plaats")["shipping"];
            $shipping->save();
            
            $billing=$business->billing;
            $billing->postcode=$request->get("postcode")["billing"];
            $billing->straat=$request->get("straat")["billing"];
            $billing->straat_url=$request->get("straat_url")["billing"];
            $billing->huisnummer=$request->get("huisnummer")["billing"];
            $billing->huisnummertoevoeging=$request->get("huisnummertoevoeging")["billing"];
            $billing->plaats=$request->get("plaats")["billing"];
            $billing->save();
            
            
            $business->handelsnaam=$request->get("handelsnaam");
            $business->handelsnaam_url=$request->get("handelsnaam_url");
            $business->kvk=$request->get("kvk");
            $business->subdossiernummer=$request->get("subdossiernummer");
            $business->bestaandehandelsnaam=$request->get("bestaandehandelsnaam");
            $business->relatie_nummer=$request->get("relatienummer");
            
            $business->save();

            Toastr::success("De klant ". $business->handelsnaam ." is succesvol bijgewerkt!");
            
            return response()->redirectToAction("Admin\BusinessController@index");
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $business=Business::find($id);
            $business->delete();

            Toastr::success("De klant ". $business->handelsnaam ." is succesvol verwijderd!");
            
            return back();
        }
        
        /**
         * @param \Illuminate\Http\Request $request
         *
         * @return mixed
         */
        public function checkRegisterNumber(Request $request)
        {
            $dossierNummer=$request->get("dossierNummer");
            $pageSize=$request->get("pageSize");
            $service_url='https://overheid.io/api/kvk/';
            $curl=curl_init(
                $service_url
                . "?query=$dossierNummer*&queryfields[]=dossiernummer&size=$pageSize"
            );
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt(
                $curl, CURLOPT_HTTPHEADER,
                ["ovio-api-key:" . " " . env("KVK_API")]
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $curl_response=curl_exec($curl);
            curl_close($curl);
            $data=(json_decode($curl_response, true));
            $kvkNummers=[];
            if (array_key_exists("_embedded", $data)) {
                foreach ($data["_embedded"]["rechtspersoon"] as $item) {
                    if (empty($kvkNummers[$item["dossiernummer"]])) {
                        $kvkNummers[$item["dossiernummer"]]["subDossiers"]=1;
                    } else {
                        $kvkNummers[$item["dossiernummer"]]["subDossiers"]+=1;
                    }
                    $kvkNummers[$item["dossiernummer"]]["handelsNaam"]
                        =$item["handelsnaam"];
                }
            } else {
                return response(["message"=>"Er zijn geen bedrijven gevonden met het opgegeven KVK nummer"]);
            }
            
            return response()->json($kvkNummers);
        }
        
        /**
         * @param \Illuminate\Http\Request $request
         *
         * @return mixed
         */
        public function getRegisterNumber(Request $request)
        {
            $dossierNummer=$request->get("dossierNummer");
            $subDossierNummer=$request->get("subDossierNummer");
            $pageSize=500;
            $service_url='https://overheid.io/api/kvk/';
            if (Cache::has($dossierNummer)) {
                $data=Cache::pull($dossierNummer);
            } else {
                $curl=curl_init(
                    $service_url . $dossierNummer . "?size=" . $pageSize
                );
                curl_setopt(
                    $curl, CURLOPT_HTTPHEADER,
                    ["ovio-api-key:" . " " . env("KVK_API")]
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $curl_response=curl_exec($curl);
                curl_close($curl);
                $data=(json_decode($curl_response, true));
                Cache::put($dossierNummer, $data, 360);
            }
            
            return response()->json($data["_embedded"]["rechtspersoon"]);
        }
        
        /**
         * @param \Illuminate\Http\Request $request
         *
         * @return mixed
         */
        public function getFullRegisterInfo(Request $request)
        {
            $dossierNummer=$request->get("dossierNummer");
            $subDossierNummer=$request->get("subDossierNummer");
            if (Cache::has($dossierNummer . $subDossierNummer)) {
                $data=Cache::pull($dossierNummer . $subDossierNummer);
            } else {
                $pageSize=500;
                $service_url='https://overheid.io/api/kvk/';
                $curl=curl_init(
                    $service_url . $dossierNummer . "/" . $subDossierNummer . "?size="
                    . $pageSize
                );
                curl_setopt(
                    $curl, CURLOPT_HTTPHEADER,
                    ["ovio-api-key:" . " " . env("KVK_API")]
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $curl_response=curl_exec($curl);
                curl_close($curl);
                $data=(json_decode($curl_response, true));
                Cache::put($dossierNummer . $subDossierNummer, $data, 360);
            }
            
            return response()->json($data);
        }
    }
