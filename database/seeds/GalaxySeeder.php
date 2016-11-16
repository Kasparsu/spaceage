<?php

use Illuminate\Database\Seeder;

class GalaxySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $points = $this->GenerateGalaxy(80000, 2, 3, 0.1, 3);
        DB::table('universes')->insert([
                                        'name' => str_random(10)
                                    ]);
        DB::table('galaxies')->insert([
                                        'universe_id' => 1,
                                             'name' => str_random(10),
                                             'type' => random_int(1,10)
                                         ]);
        foreach($points as $point){
            DB::table('star_systems')->insert([
                                                 'galaxy_id' => 1,
                                           'name' => str_random(10),
                                           'X' => $point[0]*1000,
                                           'Y' => $point[1]*1000,
                                           'type' => random_int(1,10)
                                       ]);
        }
    }
    public function GenerateGalaxy($numOfStars, $numOfArms, $spin, $armSpread, $starsAtCenterRatio) {
        $result = [];
        for ($i = 0; $i < $numOfArms; $i++) {
            $result = array_merge($result, $this->GenerateArm($numOfStars / $numOfArms, $i / $numOfArms, $spin, $armSpread, $starsAtCenterRatio));
        }
        return $result;
    }

    public function GenerateArm($numOfStars, $rotation, $spin, $armSpread, $starsAtCenterRatio) {
        $result = [];
        for ($i = 0; $i < $numOfStars; $i++)
        {
            $part = (double)$i / (double)$numOfStars;
            $part = pow($part, $starsAtCenterRatio);

            $distanceFromCenter = (float)$part;
            $position = ($part * $spin + $rotation) * M_PI * 2;

            $xFluctuation = ($this->Pow3Constrained(mt_rand(0,999)/1000) - $this->Pow3Constrained(mt_rand(0,999)/1000)) * $armSpread;
            $yFluctuation = ($this->Pow3Constrained(mt_rand(0,999)/1000) - $this->Pow3Constrained(mt_rand(0,999)/1000)) * $armSpread;

            $resultX = cos($position) * $distanceFromCenter / 2 + 0.5 + $xFluctuation;
            $resultY = sin($position) * $distanceFromCenter / 2 + 0.5 + $yFluctuation;

            $result[$i] = [$resultX, $resultY];
        }

        return $result;
    }

    public function Pow3Constrained($x)
    {
        $value = pow($x - 0.5, 3) * 4 + 0.5;
        return max(min(1, $value), 0);
    }
}
