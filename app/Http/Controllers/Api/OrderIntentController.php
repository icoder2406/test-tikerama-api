<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderIntentRequest;
use App\Http\Resources\OrderIntentResource;
use App\Models\OrderIntent;
use Exception;
use Illuminate\Http\Response;

class OrderIntentController extends Controller
{
    public function index()
    {
        try {
            // Recuperer les intentions de commande (paginée)
            $orderIntents = OrderIntent::latest('id')->paginate(10);

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Les intentions de commande sont bien récupérées',
                    'data' => OrderIntentResource::collection($orderIntents),
                    'pagination' => [
                        'total' => $orderIntents->total(),
                        'current_page' => $orderIntents->currentPage(),
                        'per_page' => $orderIntents->perPage(),
                        'last_page' => $orderIntents->lastPage(),
                        'links' => [
                            'next' => $orderIntents->nextPageUrl(),
                            'prev' => $orderIntents->previousPageUrl(),
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
                    'message' => 'Une erreur est survenue lors de la récupération des intentions de commande',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Enregistrer une nouvelle intention de commande.
     *
     * @param OrderIntentRequest $request
     * @return Response
     */
    public function store(OrderIntentRequest $request)
    {
        try {
            // Création d'une nouvelle intention de commande
            $orderIntent = OrderIntent::create($request->validated());

            // Retourner une réponse JSON avec un code de statut 201
            return response()->json(
                [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Enregistrement effectué',
                    'data' => new OrderIntentResource($orderIntent),
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
     * Consulter une intention de commande
     * @param OrderIntent $orderIntent
     * @return Response
     */
    public function show(OrderIntent $orderIntent)
    {
        try {
            // Retourner les détails de l'intention de commande
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => "Détail de l'intention de commande",
                    'data' => new OrderIntentResource($orderIntent),
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

    // Modifier une intention de commande
    public function update(OrderIntentRequest $request, OrderIntent $orderIntent)
    {
        try {
            // Mise à jour de l'intention de commande
            $orderIntent->update($request->validated());

            // Retourner une réponse JSON avec un code de statut 200 (OK)
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Modification effectuée',
                    'data' => new OrderIntentResource($orderIntent),
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

    public function destroy(OrderIntent $orderIntent)
    {
        try {
            // Supprimer l'intention de commande
            $orderIntent->delete();

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
