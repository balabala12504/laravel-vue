<?php
namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\UserRepository;
use Illuminate\Http\Request;

class UserController extends BaseRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input  = json_decode($request->input('data'), true);
        $result = UserRepository::getInstance()->lists($input);
        return response()->json($result);
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
        $input  = $request->input('data');
        $result = UserRepository::getInstance()->store($input);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = UserRepository::getInstance()->show($id);
        return response()->json($result);
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
        $input  = $request->input('data');
        $result = UserRepository::getInstance()->update($input, $id);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = UserRepository::getInstance()->destroy($id);
        // 记录操作日志
        Parent::saveOperateRecord([
            'action' => 'User/destroy',
            'params' => [
                'admin_id' => $id,
            ],
            'text'   => '删除用户成功',
        ]);
        return response()->json($result);
    }

    public function changeFieldValue($id, Request $request)
    {
        $input  = $request->input('data');
        $result = UserRepository::getInstance()->changeFieldValue($id, $input);
        return response()->json($result);
    }
}
