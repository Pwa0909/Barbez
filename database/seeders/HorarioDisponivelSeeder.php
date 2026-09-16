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
        $start = Carbon::parse('07:00');
        $end = Carbon::parse('17:00');

        for ($dia = 0; $dia <= 6; $dia++) {
            $data = Carbon::today()->addDays($dia)->toDateString();

            if (Carbon::parse($data)->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }

            foreach ($barbeiros as $barbeiroId) {
                $current = $start->copy();
                while ($current->lte($end)) {
                    $horarios[] = [
                        'barbeiro_id' => $barbeiroId,
                        'data'        => $data,
                        'hora'        => $current->format('H:i'),
                        'disponivel'  => 1,
                    ];
                    $current->addMinutes(30);
                }
            }
        }

        DB::table('horarios_disponiveis')->insertOrIgnore($horarios);

        $this->command->info('✅ Horários disponíveis criados: ' . count($horarios));
    }
}
 