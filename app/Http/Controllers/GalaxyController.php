<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class GalaxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Redis::pipeline(function ($pipe) {
            for ($i = 0; $i < 1000; $i++) {
                $pipe->set("key:$i", $i);
            }
        });
        return view('map');

    }
    public function data()
    {
        $points = $this->GenerateGalaxy(1000, 2, 1, 0.15, 1.2);
        echo(json_encode($points));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
