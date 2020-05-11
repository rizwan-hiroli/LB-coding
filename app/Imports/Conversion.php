<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Validator;
use App\Convert;

class Conversion implements ToCollection,WithHeadingRow
{

    use Importable;

    public $skippedRows = [];

    public $fullTable = '';

    public $payload = [];

    /**
     * importing data to user table.
     * @param  Collection $rows [description]
     * @return [type]           [description]
     */
    public function collection(Collection $rows)
    {
        $table = '';
        $options = ['c3e6cb','ffeeba','bee5eb','ffeeba','dee2e6','ed969e','c6c8ca'];
        $this->payload = ['average'=>round($rows->avg('rupees'),2),
                        'max'=>$rows->max('rupees'),'min'=>$rows->min('rupees')];

        $requestUrl = 'https://api.exchangerate-api.com/v4/latest/INR';
        $responseJson = file_get_contents($requestUrl);

        $rate = json_decode($responseJson)->rates->USD;
        $this->payload['rate'] = round($rate,2);
        $this->payload['time'] = now()->toDateString();

        foreach ($rows as $key=>$row) 
        {
            $validator = Validator::make($row->toArray(),['rupees'=>'required|integer']);
            if ($validator->fails()) {
                $row['error'] = $validator->errors()->first();
                array_push($this->skippedRows,array_filter($row->toArray()));
                continue; 
            }
            
            $result = round($row['rupees']*$rate,2);

            $table.= '<tr style="background-color:#'.$options[array_rand($options)].'; color:black" >
                        <td border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:top; border-color:#454d55" valign="top" >'.($key+1).'</td border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:top; border-color:#454d55" valign="top" ><td>'.$row['rupees'].'</td><td border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:top; border-color:#454d55" valign="top" >'.$rate.'</td><td border-top:1px solid #dee2e6; padding:0.75rem; vertical-align:top; border-color:#454d55" valign="top" >'.$result.'</td>
                    </tr>';

            $userDetails = Convert::create([
                            'amount' => $row['rupees'],
                            'rate' => $rate,
                            'result' => $result,
                            ]);
        }

        $this->table = $table;

    }

}