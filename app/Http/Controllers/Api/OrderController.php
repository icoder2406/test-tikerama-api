<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use Exception;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        try {
            // Recuperer les commande (paginée)
            $orders = Order::latest('id')->paginate(10);

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Les commande sont bien récupérées',
                    'data' => OrderResource::collection($orders),
                    'pagination' => [
                        'total' => $orders->total(),
                        'current_page' => $orders->currentPage(),
                        'per_page' => $orders->perPage(),
                        'last_page' => $orders->lastPage(),
                        'links' => [
                            'next' => $orders->nextPageUrl(),
                            'prev' => $orders->previousPageUrl(),
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
                    'message' => 'Une erreur est survenue lors de la récupération des commande',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function store(OrderRequest $request)
    {
        // Inclure ceci dans la reponse du commande validé
        // dd(request()->getUriForPath('/api/events/23'));

        try {
            // Création d'une nouvelle commande
            $order = Order::create($request->validated());

            // Retourner une réponse JSON avec un code de statut 201
            return response()->json(
                [
                    'status' => Response::HTTP_CREATED,
                    'message' => 'Enregistrement effectué',
                    'data' => new OrderResource($order),
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
    public function show(Order $order)
    {
        try {
            // Retourner les détails de la commande
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => "Détail de la commande $order->order_id",
                    'data' => new OrderResource($order),
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
    public function update(OrderRequest $request, Order $order)
    {
        try {
            // Mise à jour de la commande
            $order->update($request->validated());

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => 'Enregistrement effectué',
                    'data' => new OrderResource($order),
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
    public function destroy(Order $order)
    {
        try {
            // Supprimer la commande
            $order->delete();

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

    public function clientOrder($id)
    {
        try {
            // Recuperer les commanded du client
            $orders = Order::where('order_client_id', $id)->latest('id')->paginate(10);
            // Assigner le bon message selon que les types de tickets soient disponible ou pas
            $message = $orders->count() ? "Les commande du client $id sont bien récupérés" : 'Aucune associé à ce client';

            // Retourner une réponse JSON avec un code de statut 200
            return response()->json(
                [
                    'status' => Response::HTTP_OK,
                    'message' => $message,
                    'data' => OrderResource::collection($orders),
                    'pagination' => [
                        'total' => $orders->total(),
                        'current_page' => $orders->currentPage(),
                        'per_page' => $orders->perPage(),
                        'last_page' => $orders->lastPage(),
                        'links' => [
                            'next' => $orders->nextPageUrl(),
                            'prev' => $orders->previousPageUrl(),
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
                    'message' => 'Une erreur est survenue lors de la récupération des commandes',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }
}
