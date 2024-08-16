<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\TicketTypeResource;
use App\Models\TicketType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Récupérer les événements (paginé)
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            // Initier le query
            $query = Event::query();
            // filtrer les events en fonction du titre
            if ($request->title) {
                $query->where('event_title', 'LIKE', '%' . $request->title . '%');
            }
            // filtrer les events en fonction de status
            if ($request->status) {
                $query->where('event_status', 'LIKE', '%' . $request->status . '%');
            }
            // filtrer les events en fonction de categorie
            if ($request->category) {
                $query->where('event_category', 'LIKE', '%' . $request->category . '%');
            }

            $events = $query->latest('id')->paginate(10);
            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Les événements sont bien récupérés',
                    'data' => EventResource::collection($events),
                    'pagination' => [
                        'total' => $events->total(),
                        'current_page' => $events->currentPage(),
                        'per_page' => $events->perPage(),
                        'last_page' => $events->lastPage(),
                        'links' => [
                            'next' => $events->nextPageUrl(),
                            'prev' => $events->previousPageUrl(),
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
                    'message' => 'Une erreur est survenue lors de la récupération des événements',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        try {
            // Création d'un nouvel événements
            $event = Event::create($request->validated());

            // Retourner une réponse JSON avec un code de statut 201
            return response()->json(
                [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Enregistrement effectué',
                    'data' => new EventResource($event),
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
    public function show(Event $event)
    {
        try {
            // Retourner les détails de l'événémént
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => "Détail de l'événémént $event->event_id",
                    'data' => new EventResource($event),
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
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        try {
            // Mise à jour de l'événement
            $event->update($request->validated());

            // Retourner une réponse JSON avec un code de statut 200 (OK)
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Modification effectuée',
                    'data' => new EventResource($event),
                ],
                Response::HTTP_OK,
            );
        } catch (Exception $e) {
            // Retourner une réponse JSON avec un code de statut 500 (Internal Server Error) pour les erreurs
            return response()->json(
                [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Une erreur est survenue lors de la modification.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            // Supprimer l'événement
            $event->delete();

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

     /**
     * Liste de types de tickets pour un événement donné
     * @param $id
     */
    public function eventTicket($id)
    {
        try {
            // Recuperer les types de tickets
            $eventTickets = TicketType::where('ticket_type_event_id', $id)->latest('id')->paginate(10);
            // Assigner le bon message selon que les types de tickets soient disponible ou pas
            $message = $eventTickets->count() ? "Les types de tickets de l'événement $id sont bien récupérés" : "Aucun ticket n'est disponible pour cet événement";

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => $message,
                    'data' => TicketTypeResource::collection($eventTickets),
                    'pagination' => [
                        'total' => $eventTickets->total(),
                        'current_page' => $eventTickets->currentPage(),
                        'per_page' => $eventTickets->perPage(),
                        'last_page' => $eventTickets->lastPage(),
                        'links' => [
                            'next' => $eventTickets->nextPageUrl(),
                            'prev' => $eventTickets->previousPageUrl(),
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
                    'message' => 'Une erreur est survenue lors de la récupération des événements.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
