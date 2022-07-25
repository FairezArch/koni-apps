<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\CalendarActivitie;
use App\Http\Requests\StoreCalendarActivitieRequest;
use App\Http\Requests\UpdateCalendarActivitieRequest;

class CalendarActivitieController extends Controller
{
    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = CalendarActivitie::IndexPage();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (CalendarActivitie $calendar) {
                    return $calendar->match_name;
                })
                ->addColumn('time', function (CalendarActivitie $calendar) {
                    return $this->attrFormat(Carbon::parse($calendar->date_from)->format('d F Y'), Carbon::parse($calendar->date_to)->format('d F Y'));
                })
                ->addColumn('sport_branch', function (CalendarActivitie $calendar) {
                    return $calendar->sports->sportbranch_name;
                })
                ->addColumn('place', function (CalendarActivitie $calendar) {
                    return '<a href="'.$calendar->address.'" target="_blank">Maps</a>';
                })
                ->addColumn('action', function (CalendarActivitie $calendar) {
                    return $calendar->id;
                })
                ->rawColumns(['name', 'time', 'sport_branch', 'place', 'action'])
                ->make(true);
        }

        return view('backend.pages.calendarActivitie.index-calendarActivitie');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sports = Sport::all();
        return view('backend.pages.calendarActivitie.add-calendarActivitie', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarActivitieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarActivitieRequest $request)
    {
        //
        $save = CalendarActivitie::StoreData($request);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Calendar Aktivitie created successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Calendar Aktivitie created unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalendarActivitie  $CalendarActivitie
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarActivitie $CalendarActivitie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendarActivitie  $CalendarActivitie
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarActivitie $calendar_activitie)
    {
        //
        $sports = Sport::all();
        return view('backend.pages.calendarActivitie.edit-calendarActivitie', compact('calendar_activitie', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarActivitieRequest  $request
     * @param  \App\Models\CalendarActivitie  $CalendarActivitie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalendarActivitieRequest $request, CalendarActivitie $calendar_activitie)
    {
        //
        $up = CalendarActivitie::UpdateData($request, $calendar_activitie);

        if ($up) {
            $data = [
                'success' => true,
                'messages' => "Calendar Aktivitie updated successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Calendar Aktivitie updated unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendarActivitie  $CalendarActivitie
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarActivitie $calendar_activitie)
    {
        //
        $del = CalendarActivitie::DeleteData($calendar_activitie);

        if ($del) {
            $data = [
                'success' => true,
                'messages' => "Calendar Aktivitie deleted successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Calendar Aktivitie deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }

    public function getStateFromCountrie(CalendarActivitie $calendar, $countrie_id)
    {
        # code...
        $stateOfCountrie = $calendar->getState($countrie_id);

        if ($stateOfCountrie) {
            $data = [
                'success' => true,
                'messages' => "Get State successfully",
                'data' => $stateOfCountrie
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Get State unsuccessfully",
                'data' => ''
            ];
        }

        return response()->json($data);
    }

    public function getCityFromState(CalendarActivitie $calendar, $state_id)
    {
        # code...
        $citieOfState = $calendar->getCitie($state_id);

        if ($citieOfState) {
            $data = [
                'success' => true,
                'messages' => "Get Citie successfully",
                'data' => $citieOfState
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Get Citie unsuccessfully",
                'data' => ''
            ];
        }

        return response()->json($data);
    }
}
