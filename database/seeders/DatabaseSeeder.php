<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Office;
use App\Models\Barangay;
use App\Models\Position;
use App\Models\RevenueType;
use Illuminate\Database\Seeder;
use App\Models\AccountableFormType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DashboardTableSeeder::class,
        ]);

        Office::factory()->create(['name' => 'Treasury', 'is_active' => 1]);
        Office::factory()->create(['name' => 'Market', 'is_active' => 1]);

        Position::factory()->create(['name' => 'Collector', 'is_active' => 1]);
        Position::factory()->create(['name' => 'Consolidator', 'is_active' => 1]);
        Position::factory()->create(['name' => 'Treasurer', 'is_active' => 1]);


        User::factory()->create(['dob'=> '2000-01-01', 'name'=> 'Ricky', 'last_name' => 'Bulalakaw', 'email' => 'rbulalakaw@gmail.com', 'password' => 'password', 'is_active' => User::STATUS_ACTIVE, 'function' => User::IS_ADMIN]);
        User::factory()->create(['dob'=> '2000-01-01', 'name'=> 'Jose', 'last_name' => 'Rizal', 'email' => 'jose@rizal.com', 'password' => 'password', 'is_active' => User::STATUS_ACTIVE, 'position_id' => 2, 'office_id' => 1, 'function' => User::IS_CONSOLIDATOR]);
        User::factory()->create(['dob'=> '2000-01-01', 'name'=> 'Andres', 'last_name' => 'Bonifacio', 'email' => 'andres@bonifacio.com', 'password' => 'password', 'is_active' => User::STATUS_ACTIVE, 'position_id' => 1, 'office_id' => 1, 'supervisor_id' => 2, 'function' => User::IS_COLLECTOR]);


        AccountableFormType::factory()->create(['name' => 'Official Receipt', 'number' => '51', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Certificate of Transfer of Large Cattle', 'number' => '52', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Certificate of Ownership of Large Cattle', 'number' => '53', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Marriage License Certificate', 'number' => '54', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Cash Ticket @ 5', 'number' => '55A', 'default_amount' => "5"]);
        AccountableFormType::factory()->create(['name' => 'Cash Ticket @ 10', 'number' => '55B', 'default_amount' => "10"]);
        AccountableFormType::factory()->create(['name' => 'Real Property Tax Receipt', 'number' => '56', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Community Tax Certificate (Individual)', 'number' => 'CTC-I', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Community Tax Certificate (Corporation)', 'number' => 'CTC-C', 'default_amount' => null]);
        
        // CTC Fees
        RevenueType::factory()->create(['column_display' => 'A', 'single_display' => 'Basic Community Tax', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'B', 'single_display' => 'Individual Additional Community Tax', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'C', 'single_display' => 'C', 'fund' => 100]);        
        RevenueType::factory()->create(['column_display' => 'C1', 'single_display' => 'C1', 'fund' => 100]);

        // RevenueType::factory()->create(['name' => 'Real Property Tax']);
        
        RevenueType::factory()->create(['column_display' => 'Stall Fees', 'single_display' => 'Stall Fees', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Special Permit', 'single_display' => 'Special Permit', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Cash Ticket', 'single_display' => 'Cash Ticket', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Bagsakan', 'single_display' => 'CT Bagsakan', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Parking Fee', 'single_display' => 'CT Parking Fee', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Park', 'single_display' => 'CT Amusement Park', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Terminal', 'single_display' => 'CT Amusement Terminal', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Big Bus AM', 'single_display' => 'CT Amusement Big Bus AM', 'fund' => 100]);

        // RPT Fees
        RevenueType::factory()->create(['column_display' => 'Current Year', 'single_display' => 'RPT Basic-Current Year', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Penalties', 'single_display' => 'RPT Basic-Current Year-Penalty', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Immediate Preceeding Year', 'single_display' => 'RPT Basic-Previous Year', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Penalties', 'single_display' => 'RPT Basic-Previous Year-Penalty', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Current Year', 'single_display' => 'RPT SEF-Current Year', 'fund' => 200]);
        RevenueType::factory()->create(['column_display' => 'Penalties', 'single_display' => 'RPT SEF-Current Year-Penalty', 'fund' => 200]);
        RevenueType::factory()->create(['column_display' => 'Immediate Preceeding Year', 'single_display' => 'RPT SEF-Previous Year', 'fund' => 200]);
        RevenueType::factory()->create(['column_display' => 'Penalties', 'single_display' => 'RPT SEF-Previous Year-Penalty', 'fund' => 200]);
        
        
        // Barangay::factory()->create();

        Barangay::factory ()->create(['psgc' => '015511001', 'name' =>	'Alinggan']);
        Barangay::factory ()->create(['psgc' => '015511002', 'name' =>	'Amamperez']);
        Barangay::factory ()->create(['psgc' => '015511003', 'name' =>	'Amancosiling Norte']);
        Barangay::factory ()->create(['psgc' => '015511004', 'name' =>	'Amancosiling Sur']);
        Barangay::factory ()->create(['psgc' => '015511005', 'name' =>	'Ambayat I']);
        Barangay::factory ()->create(['psgc' => '015511006', 'name' =>	'Ambayat II']);
        Barangay::factory ()->create(['psgc' => '015511007', 'name' =>	'Apalen']);
        Barangay::factory ()->create(['psgc' => '015511008', 'name' =>	'Asin']);
        Barangay::factory ()->create(['psgc' => '015511009', 'name' =>	'Ataynan']);
        Barangay::factory ()->create(['psgc' => '015511010', 'name' =>	'Bacnono']);
        Barangay::factory ()->create(['psgc' => '015511011', 'name' =>	'Balaybuaya']);
        Barangay::factory ()->create(['psgc' => '015511012', 'name' =>	'Banaban']);
        Barangay::factory ()->create(['psgc' => '015511013', 'name' =>	'Bani']);
        Barangay::factory ()->create(['psgc' => '015511014', 'name' =>	'Batangcawa']);
        Barangay::factory ()->create(['psgc' => '015511015', 'name' =>	'Beleng']);
        Barangay::factory ()->create(['psgc' => '015511016', 'name' =>	'Bical Norte']);
        Barangay::factory ()->create(['psgc' => '015511017', 'name' =>	'Bical Sur']);
        Barangay::factory ()->create(['psgc' => '015511018', 'name' =>	'Bongato East']);
        Barangay::factory ()->create(['psgc' => '015511019', 'name' =>	'Bongato West']);
        Barangay::factory ()->create(['psgc' => '015511020', 'name' =>	'Buayaen']);
        Barangay::factory ()->create(['psgc' => '015511021', 'name' =>	'Buenlag 1st']);
        Barangay::factory ()->create(['psgc' => '015511022', 'name' =>	'Buenlag 2nd']);
        Barangay::factory ()->create(['psgc' => '015511023', 'name' =>	'Cadre Site']);
        Barangay::factory ()->create(['psgc' => '015511024', 'name' =>	'Carungay']);
        Barangay::factory ()->create(['psgc' => '015511025', 'name' =>	'Caturay']);
        Barangay::factory ()->create(['psgc' => '015511027', 'name' =>	'Duera']);
        Barangay::factory ()->create(['psgc' => '015511028', 'name' =>	'Dusoc']);
        Barangay::factory ()->create(['psgc' => '015511029', 'name' =>	'Hermoza']);
        Barangay::factory ()->create(['psgc' => '015511030', 'name' =>	'Idong']);
        Barangay::factory ()->create(['psgc' => '015511031', 'name' =>	'Inanlorenzana']);
        Barangay::factory ()->create(['psgc' => '015511032', 'name' =>	'Inirangan']);
        Barangay::factory ()->create(['psgc' => '015511033', 'name' =>	'Iton']);
        Barangay::factory ()->create(['psgc' => '015511034', 'name' =>	'Langiran']);
        Barangay::factory ()->create(['psgc' => '015511035', 'name' =>	'Ligue']);
        Barangay::factory ()->create(['psgc' => '015511036', 'name' =>	'M. H. del Pilar']);
        Barangay::factory ()->create(['psgc' => '015511037', 'name' =>	'Macayocayo']);
        Barangay::factory ()->create(['psgc' => '015511038', 'name' =>	'Magsaysay']);
        Barangay::factory ()->create(['psgc' => '015511039', 'name' =>	'Maigpa']);
        Barangay::factory ()->create(['psgc' => '015511040', 'name' =>	'Malimpec']);
        Barangay::factory ()->create(['psgc' => '015511041', 'name' =>	'Malioer']);
        Barangay::factory ()->create(['psgc' => '015511042', 'name' =>	'Managos']);
        Barangay::factory ()->create(['psgc' => '015511043', 'name' =>	'Manambong Norte']);
        Barangay::factory ()->create(['psgc' => '015511044', 'name' =>	'Manambong Parte']);
        Barangay::factory ()->create(['psgc' => '015511045', 'name' =>	'Manambong Sur']);
        Barangay::factory ()->create(['psgc' => '015511046', 'name' =>	'Mangayao']);
        Barangay::factory ()->create(['psgc' => '015511047', 'name' =>	'Nalsian Norte']);
        Barangay::factory ()->create(['psgc' => '015511048', 'name' =>	'Nalsian Sur']);
        Barangay::factory ()->create(['psgc' => '015511049', 'name' =>	'Pangdel']);
        Barangay::factory ()->create(['psgc' => '015511050', 'name' =>	'Pantol']);
        Barangay::factory ()->create(['psgc' => '015511051', 'name' =>	'Paragos']);
        Barangay::factory ()->create(['psgc' => '015511053', 'name' =>	'Poblacion Sur']);
        Barangay::factory ()->create(['psgc' => '015511054', 'name' =>	'Pugo']);
        Barangay::factory ()->create(['psgc' => '015511055', 'name' =>	'Reynado']);
        Barangay::factory ()->create(['psgc' => '015511056', 'name' =>	'San Gabriel 1st']);
        Barangay::factory ()->create(['psgc' => '015511057', 'name' =>	'San Gabriel 2nd']);
        Barangay::factory ()->create(['psgc' => '015511058', 'name' =>	'San Vicente']);
        Barangay::factory ()->create(['psgc' => '015511059', 'name' =>	'Sangcagulis']);
        Barangay::factory ()->create(['psgc' => '015511060', 'name' =>	'Sanlibo']);
        Barangay::factory ()->create(['psgc' => '015511061', 'name' =>	'Sapang']);
        Barangay::factory ()->create(['psgc' => '015511062', 'name' =>	'Tamaro']);
        Barangay::factory ()->create(['psgc' => '015511063', 'name' =>	'Tambac']);
        Barangay::factory ()->create(['psgc' => '015511064', 'name' =>	'Tampog']);
        Barangay::factory ()->create(['psgc' => '015511065', 'name' =>	'Darawey (Tangal)']);
        Barangay::factory ()->create(['psgc' => '015511066', 'name' =>	'Tanolong']);
        Barangay::factory ()->create(['psgc' => '015511067', 'name' =>	'Tatarao']);
        Barangay::factory ()->create(['psgc' => '015511068', 'name' =>	'Telbang']);
        Barangay::factory ()->create(['psgc' => '015511069', 'name' =>	'Tococ East']);
        Barangay::factory ()->create(['psgc' => '015511070', 'name' =>	'Tococ West']);
        Barangay::factory ()->create(['psgc' => '015511071', 'name' =>	'Warding']);
        Barangay::factory ()->create(['psgc' => '015511072', 'name' =>	'Wawa']);
        Barangay::factory ()->create(['psgc' => '015511073', 'name' =>	'Zone I (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511074', 'name' =>	'Zone II (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511075', 'name' =>	'Zone III (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511076', 'name' =>	'Zone IV (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511077', 'name' =>	'Zone V (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511078', 'name' =>	'Zone VI (Pob.)']);
        Barangay::factory ()->create(['psgc' => '015511079', 'name' =>	'Zone VII (Pob.)']);

    }
}
