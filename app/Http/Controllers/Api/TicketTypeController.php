<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketTypeRequest;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketTypeController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Recuperer les types de tickets (paginée)
            $ticketTypes = TicketType::latest('id')->paginate(10);

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Les tickets sont bien récupérés',
                    'data' => TicketTypeResource::collection($ticketTypes),
                    'pagination' => [
                        'total' => $ticketTypes->total(),
                        'current_page' => $ticketTypes->currentPage(),
                        'per_page' => $ticketTypes->perPage(),
                        'last_page' => $ticketTypes->lastPage(),
                        'links' => [
                            'next' => $ticketTypes->nextPageUrl(),
                            'prev' => $ticketTypes->previousPageUrl(),
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


    public function store(TicketTypeRequest $request)
    {
        try {
            // Création d'un nouveau type de ticket
            $ticketType = TicketType::create($request->validated());

            // Retourner une réponse JSON avec un code de statut 201
            return response()->json(
                [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Enregistrement effectué',
                    'data' => new TicketTypeResource($ticketType),
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
    public function show(TicketType $ticketType)
    {
        try {
            // Retourner les détails du type de ticket
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => "Détail du ticket $ticketType->ticket_type_id",
                    'data' => new TicketTypeResource($ticketType),
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

    public function update(TicketTypeRequest $request, TicketType $ticketType)
    {
        try {
            // Mise à jour d'un type deticket
            $ticketType->update($request->validated());

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Enregistrement effectué',
                    'data' => new TicketTypeResource($ticketType),
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

    public function destroy(TicketType $ticketType)
    {
        {
            try {
                // Supprimer un type de ticket
                $ticketType->delete();

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
        }    }
}
