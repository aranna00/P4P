<?php
    
    use App\Business;
    use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Business $business */
        $business = Business::findOrNew(1);
        $business->id = 1;
        $business->billing_address = 1;
        $business->shipping_address = 1;
        $business->bestaandehandelsnaam = "test";
        $business->dossiernummer = 1;
        $business->subdossiernummer = 1;
        $business->handelsnaam = "test";
        $business->handelsnaam_url = "test";
        $business->save();
    }
}
