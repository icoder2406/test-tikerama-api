<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use Exception;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Recuperer les tickets (paginée)
            $tickets = Ticket::latest('id')->paginate(10);

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Les tickets sont bien récupérés',
                    'data' => TicketResource::collection($tickets),
                    'pagination' => [
                        'total' => $tickets->total(),
                        'current_page' => $tickets->currentPage(),
                        'per_page' => $tickets->perPage(),
                        'last_page' => $tickets->lastPage(),
                        'links' => [
                            'next' => $tickets->nextPageUrl(),
                            'prev' => $tickets->previousPageUrl(),
                        ],
                    ],
                ],
                Response::HTTP_OK,
            );
        } catch (\Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Une erreur est survenue lors de la récupération des tickets',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        try {
            // Création d'un ticket
            $ticket = Ticket::create($request->validated());

            // Retourner une réponse JSON avec un code de statut 201
            return response()->json(
                [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Enregistrement effectué',
                    'data' => new TicketResource($ticket),
                ],
                Response::HTTP_CREATED,
            );
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => "Une erreur est survenue lors de l'enregistrement.",
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        try {
            // Retourner les détails du ticket
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => "Détail du ticket $ticket->ticket_id",
                    'data' => new TicketResource($ticket),
                ],
                Response::HTTP_OK,
            );
        } catch (\Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Une erreur est survenue lors de la récupération des détails.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {
            // Mise à jour du ticket
            $ticket->update($request->validated());

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Enregistrement effectué',
                    'data' => new TicketResource($ticket),
                ],
                Response::HTTP_OK,
            );
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => "Une erreur est survenue lors de l'enregistrement.",
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        try {
            // Supprimer du ticket
            $ticket->delete();

            // Retourner une réponse JSON avec un code de statut 204 (No Content)
            return response()->json(
                [
                    'status' => Response::HTTP_NO_CONTENT,
                    'message' => 'Suppression effectuée',
                ],
                Response::HTTP_NO_CONTENT,
            );
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Une erreur est survenue lors de la suppression.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
