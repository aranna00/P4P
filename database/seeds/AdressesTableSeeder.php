<?php
    
    use App\Address;
    use Illuminate\Database\Seeder;

class AdressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Address $address */
        $address = Address::findOrNew(1);
        $address->id = 1;
        $address->plaats = "test";
        $address->postcode = "1234AB";
        $address->straat = "test";
        $address->straat_url = "test";
        $address->huisnummer = 1;
        $address->save();
    }
}
