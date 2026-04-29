<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class HorarioDisponivelSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [];
 
       
        $barbeiros = [1, 2, 3];
        $horasDia  = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
 
        for ($dia = 0; $dia <= 6; $dia++) {
            $data = Carbon::today()->addDays($dia)->toDateString();
 
            // Pula domingo
            if (Carbon::parse($data)->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }
 
            foreach ($barbeiros as $barbeiroId) {
                foreach ($horasDia as $hora) {
                    $horarios[] = [
                        'barbeiro_id' => $barbeiroId,
                        'data'        => $data,
                        'hora'        => $hora,
                        'disponivel'  => 1,
                    ];
                }
            }
        }
 
        DB::table('horarios_disponiveis')->insert($horarios);
 
        $this->command->info('✅ Horários disponíveis criados: ' . count($horarios));
    }
}
 