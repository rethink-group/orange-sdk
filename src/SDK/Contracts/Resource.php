<?php

namespace RethinkGroup\SDK\Contracts;

interface Resource
{
    /** 
     * Retrieve the specified resource by primary key.
     * 
     * @param  int    $id The resource's primary key.
     * @return array The retrieved resource.
     */
    public function find(int $id);

    /** 
     * Store a new resource in storage.
     * 
     * @param  array  $data The resource's attributes.
     * @return array The newly created resource.
     */
    public function store(array $data);
    
    /** 
     * Update the specified resource.
     * 
     * @param  int    $id   The resource's primary key.
     * @param  array  $data The resource's attributes.
     * @return array The updated resource.
     */
    public function update(int $id, array $data);

    /** 
     * Remove the specified resource from storage.
     * 
     * @param  int    $id The resource's primary key.
     * @return bool
     */
    public function delete(int $id);
}