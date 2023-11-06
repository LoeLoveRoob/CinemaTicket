<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            TicketResource::collection(Ticket::with("roles")->get()),
            "ticket.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request): JsonResponse
    {
        if ($request->ticket()->cannot("create", Ticket::class)){
            abort(403);
        }
        $ticket = Ticket::create($request->validated());
        if ($ticket){
            return $this->successResponse(
                TicketResource::make($ticket),
                "ticket.success_store"
            );
        } else {
            return $this->errorResponse(
                "False",
                "ticket.failed_store"
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): JsonResponse
    {
        return $this->successResponse(
            TicketResource::make($ticket),
            "ticket.success_show",
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket): JsonResponse
    {
        $ticket->update($request->validated());
        return $this->successResponse(
            TicketResource::make($ticket),
            "ticket.success_update",
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        if ($ticket->delete()){
            return $this->successResponse(
                "True",
                "ticket.success_destroy",
            );
        } else {
            return $this->errorResponse(
                "False",
                "ticket.failed_destroy"
            );
        }
    }
}
